<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
        }

        h1 {
            background-color: #ffcccc;
            color: #ff6600;
            padding: 15px;
            font-size: 24px;
            margin: 0;
        }

        .product-detail {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
        }

        .product-detail img {
            width: 150px;
            height: auto;
            float: left;
            margin-right: 20px;
        }

        .product-info {
            overflow: hidden;
        }

        .product-info h2 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .product-info p {
            font-size: 16px;
            color: #666;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>CHI TIẾT SẢN PHẨM</h1>

    <div class="product-detail">
        <?php
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "ql_ban_sua");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Lấy mã sản phẩm từ URL
        $ma_sua = $_GET['ma_sua'];

        // Truy vấn chi tiết sản phẩm
        $sql = "SELECT * FROM products WHERE ma_sua = '$ma_sua'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<img src='" . $row['image'] . "' alt='" . $row['ten_sua'] . "'>";
            echo "<div class='product-info'>";
            echo "<h2>" . $row['ten_sua'] . "</h2>";
            echo "<p>Nhà sản xuất: " . $row['hang_sua'] . "</p>";
            echo "<p>Trọng lượng: " . $row['trong_luong'] . "</p>";
            echo "<p>Giá: " . number_format($row['gia']) . " VND</p>";
            echo "<p>Thành phần dinh dưỡng: " . $row['thanhphan_dinhduong'] . "</p>";
            echo "<p>Lợi ích: " . $row['loi_ich'] . "</p>";
            echo "</div>";
        } else {
            echo "<p>Không tìm thấy sản phẩm.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
