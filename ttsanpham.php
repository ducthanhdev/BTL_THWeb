<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Các Sản Phẩm</title>
    <style>
        /* CSS giống như yêu cầu ở câu trước */
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

        .product-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            justify-items: center;
            margin: 20px auto;
            width: 90%;
            max-width: 1000px;
        }

        .product {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            width: 100%;
        }

        .product img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .product-info h2 {
            font-size: 16px;
            color: #333;
            margin: 5px 0;
        }

        .product-info p {
            font-size: 12px;
            color: #666;
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <h1>THÔNG TIN CÁC SẢN PHẨM</h1>
    <div class="product-container">
        <?php
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "ql_ban_sua");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Lấy dữ liệu sản phẩm
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['ten_sua'] . "'>";
                echo "<div class='product-info'>";
                // Tạo link với mã sản phẩm truyền vào qua URL
                echo "<h2><a href='chitietsanpham.php?ma_sua=" . $row['ma_sua'] . "'>" . $row['ten_sua'] . "</a></h2>";
                echo "<p>" . $row['trong_luong'] . " gr - " . number_format($row['gia']) . " VND</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
