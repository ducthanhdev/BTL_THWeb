<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Thông Tin Sữa</title>
    <style>
        /* CSS cho trang tìm kiếm */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
        }

        h1 {
            color: #ff3333;
            font-size: 24px;
            margin-top: 20px;
        }

        .search-container {
            background-color: #ffe6e6;
            padding: 15px;
            margin-bottom: 20px;
            display: inline-block;
            border-radius: 8px;
        }

        .search-container input[type="text"] {
            padding: 5px;
            width: 200px;
            margin-right: 5px;
        }

        .search-container input[type="submit"] {
            padding: 5px 10px;
            color: white;
            background-color: #ff3399;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-container {
            width: 70%;
            margin: 0 auto;
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

        .product-info .highlight {
            color: #ff0000;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <h1>TÌM KIẾM THÔNG TIN SỮA</h1>

    <div class="search-container">
        <form action="" method="get">
            <label for="search">Tên sữa:</label>
            <input type="text" id="search" name="search" placeholder="Nhập tên sữa">
            <input type="submit" value="Tìm kiếm">
        </form>
    </div>

    <div class="product-container">
        <?php
        // Kiểm tra nếu người dùng đã nhập từ khóa tìm kiếm
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            // Kết nối tới cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "ql_ban_sua");
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Lấy từ khóa tìm kiếm
            $searchTerm = $conn->real_escape_string($_GET['search']);

            // Thực hiện truy vấn tìm kiếm tên sữa
            $sql = "SELECT * FROM products WHERE ten_sua LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Hiển thị số sản phẩm tìm thấy
                echo "<p><strong>Có " . $result->num_rows . " sản phẩm được tìm thấy</strong></p>";

                // Duyệt qua các sản phẩm và hiển thị thông tin
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . $row['image'] . "' alt='" . $row['ten_sua'] . "'>";
                    echo "<div class='product-info'>";
                    echo "<h2>" . $row['ten_sua'] . " - " . $row['hang_sua'] . "</h2>";
                    echo "<p><strong>Thành phần dinh dưỡng:</strong> " . $row['thanhphan_dinhduong'] . "</p>";
                    echo "<p><strong>Lợi ích:</strong> " . $row['loi_ich'] . "</p>";

                    echo "<p><strong>Trọng lượng:</strong> <span class='highlight'>" . $row['trong_luong'] . "</span> gr - <strong>Đơn giá:</strong> <span class='highlight'>" . number_format($row['gia']) . " VND</span></p>";

                    echo "</div>";
                    echo "<div style='clear:both;'></div>";
                    echo "</div>";
                }
            } else {
                // Nếu không tìm thấy sản phẩm nào
                echo "<p><strong>Không tìm thấy sản phẩm này.</strong></p>";
            }

            $conn->close();
        } else {
            echo "<p>Vui lòng nhập từ khóa tìm kiếm.</p>";
        }
        ?>
    </div>
</body>
</html>
