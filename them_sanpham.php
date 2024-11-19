<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "QL_BAN_SUA";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_sua = $conn->real_escape_string($_POST['ma_sua']);
    $ten_sua = $conn->real_escape_string($_POST['ten_sua']);
    $hang_sua = $conn->real_escape_string($_POST['hang_sua']);
    $loai_sua = $conn->real_escape_string($_POST['loai_sua']);
    $trong_luong = $conn->real_escape_string($_POST['trong_luong']);
    $gia = $conn->real_escape_string($_POST['gia']);
    $thanhphan_dinhduong = $conn->real_escape_string($_POST['thanhphan_dinhduong']);
    $loi_ich = $conn->real_escape_string($_POST['loi_ich']);

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/"; // Directory to save uploaded images
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $image_path = $target_dir . basename($_FILES["image"]["name"]);

        // Check if the file is an actual image
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false && move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            echo "Image uploaded successfully.<br>";
        } else {
            echo "Failed to upload image.<br>";
            exit;
        }
    } else {
        echo "No image uploaded or upload error.<br>";
        exit;
    }

    // Validate input
    if (empty($ma_sua) || empty($ten_sua) || empty($hang_sua) || empty($loai_sua) || empty($trong_luong) || empty($gia)) {
        echo "Kiểm tra lại thông tin nhập vào<br>";
    } else {
        // Prepare statement to insert data into database
        $stmt = $conn->prepare("INSERT INTO products (ma_sua, ten_sua, hang_sua, loai_sua, trong_luong, gia, thanhphan_dinhduong, loi_ich, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssidsiss", $ma_sua, $ten_sua, $hang_sua, $loai_sua, $trong_luong, $gia, $thanhphan_dinhduong, $loi_ich, $image_path);

        if ($stmt->execute()) {
            echo "<h2>Sản phẩm đã thêm thành công!</h2>";

            // Hiển thị thông tin sản phẩm đã thêm
            echo "<div style='border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; margin-right:50px;'>";
            echo "<h3 style='color: #990000;'>$ten_sua - $hang_sua</h3>";
            echo "<p><strong>Loại sữa:</strong> $loai_sua</p>";
            echo "<p><strong>Trọng lượng:</strong> <span style='color: red;'>$trong_luong g</span> - <strong>Giá:</strong> <span style='color: red;'>$gia VNĐ</span></p>";
            echo "<p><strong>Thành phần dinh dưỡng:</strong> $thanhphan_dinhduong</p>";
            echo "<p><strong>Lợi ích:</strong> $loi_ich</p>";
            echo "<img src='$image_path' alt='$ten_sua' style='width:150px;height:auto;'><br>";
            echo "</div>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sữa Mới</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Main container */
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        /* Heading styling */
        h1 {
            text-align: center;
            color: #990000;
            margin-bottom: 20px;
        }

        /* Form styling */
        form label {
            font-weight: bold;
            color: #333;
        }

        form input[type="text"],
        form input[type="number"],
        form select,
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        form textarea {
            height: 80px;
            resize: vertical;
        }

        /* Button styling */
        button {
            width: 100%;
            padding: 10px;
            background-color: #990000;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #cc0000;
        }

        /* Display box for added product */
        .product-info {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .product-info h3 {
            color: #990000;
            margin-bottom: 10px;
        }

        .product-info p {
            margin-bottom: 5px;
            color: #333;
        }

        .product-info span {
            color: red;
            font-weight: bold;
        }

        /* Image styling */
        img {
            display: block;
            max-width: 150px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm Sữa Mới</h1>
        <form action="them_sanpham.php" method="POST" enctype="multipart/form-data">
            <label for="ma_sua">Mã sữa:</label>
            <input type="text" id="ma_sua" name="ma_sua" required>

            <label for="ten_sua">Tên sữa:</label>
            <input type="text" id="ten_sua" name="ten_sua" required>

            <label for="hang_sua">Hãng sữa:</label>
            <select id="hang_sua" name="hang_sua" required>
                <option value="">Chọn hãng sữa</option>
                <option value="Vinamilk">Vinamilk</option>
                <option value="TH True Milk">TH True Milk</option>
                <option value="Mộc Châu">Mộc Châu</option>
                <option value="Nutifood">Nutifood</option>
                <option value="Dutch Lady">Dutch Lady</option>
                <option value="Nestle">Nestle</option>
                <option value="Friso">Friso</option>
                <option value="Dumex">Dumex</option>
                <option value="Abbott">Abbott</option>
            </select>

            <label for="loai_sua">Loại sữa:</label>
            <select id="loai_sua" name="loai_sua" required>
                <option value="Sữa tươi">Sữa tươi</option>
                <option value="Sữa bột">Sữa bột</option>
            </select>

            <label for="trong_luong">Trọng lượng (g):</label>
            <input type="number" id="trong_luong" name="trong_luong" required>

            <label for="gia">Đơn giá (VNĐ):</label>
            <input type="number" id="gia" name="gia" required>

            <label for="thanhphan_dinhduong">Thành phần dinh dưỡng:</label>
            <textarea id="thanhphan_dinhduong" name="thanhphan_dinhduong"></textarea>

            <label for="loi_ich">Lợi ích:</label>
            <textarea id="loi_ich" name="loi_ich"></textarea>

            <label for="image">Hình ảnh sản phẩm:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Thêm mới</button>
        </form>
    </div>
</body>
</html>
