<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Chi Tiết Các Loại Sữa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
        }

        h1 {
            color: #ff6699;
            font-size: 24px;
            margin-top: 20px;
        }

        .product-container {
            width: 70%;
            margin: 20px auto;
            text-align: left;
        }

        .product-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
        }

        .product-item img {
            float: left;
            width: 120px;
            margin-right: 15px;
        }

        .product-info h2 {
            color: #ff6699;
            margin: 0;
            font-size: 18px;
        }

        .product-info p {
            font-size: 14px;
            margin: 5px 0;
            color: #666;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a, .pagination .current-page {
            margin: 0 5px;
            padding: 5px 10px;
            color: #ff6699;
            text-decoration: none;
        }

        .pagination .current-page {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>THÔNG TIN CHI TIẾT CÁC LOẠI SỮA</h1>

    <div class="product-container">
        <?php
        include 'Pager.php';  // Gọi file class Pager

        // Kết nối cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "ql_ban_sua");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Đếm tổng số sản phẩm
        $countSql = "SELECT COUNT(*) AS total FROM products";
        $countResult = $conn->query($countSql);
        $totalItems = $countResult->fetch_assoc()['total'];

        // Khởi tạo phân trang với 2 sản phẩm mỗi trang
        $pager = new Pager($totalItems, 2);
        $offset = $pager->getOffset();

        // Lấy dữ liệu sản phẩm với phân trang
        $sql = "SELECT * FROM products LIMIT $offset, 2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['ten_sua'] . "'>";
                echo "<div class='product-info'>";
                echo "<h2>" . $row['ten_sua'] . " - " . $row['hang_sua'] . "</h2>";
                echo "<p><strong>Thành phần dinh dưỡng:</strong> " . $row['thanhphan_dinhduong'] . "</p>";
                echo "<p><strong>Thành phần dinh dưỡng:</strong> " . $row['loi_ich'] . "</p>";
                echo "<p><strong>Trọng lượng:</strong> " . $row['trong_luong'] . " - <strong>Đơn giá:</strong> " . number_format($row['gia']) . " VND</p>";
                echo "</div>";
                echo "<div style='clear:both;'></div>";
                echo "</div>";
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }

        // Hiển thị phân trang
        echo $pager->renderLinks();

        $conn->close();
        ?>
    </div>
</body>
</html>
