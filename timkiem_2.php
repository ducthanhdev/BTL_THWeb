<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Nâng Cao</title>
    <style>
        /* CSS cho trang tìm kiếm nâng cao */
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

        .search-container {
            background-color: #ffe6e6;
            padding: 15px;
            margin-bottom: 20px;
            display: inline-block;
            border-radius: 8px;
        }

        .search-container input[type="text"], .search-container select {
            padding: 5px;
            margin: 5px;
        }

        .search-container input[type="submit"] {
            padding: 5px 10px;
            color: white;
            background-color: #ff6699;
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
    <h1>TÌM KIẾM NÂNG CAO</h1>

    <div class="search-container">
        <form action="" method="get">
            <label for="ten_sua">Tên sữa:</label>
            <input type="text" id="ten_sua" name="ten_sua" placeholder="Nhập tên sữa">

            <label for="loai_sua">Loại sữa:</label>
            <select id="loai_sua" name="loai_sua">
                <option value="">Chọn loại sữa</option>
                <option value="Sữa bột">Sữa bột</option>
                <option value="Sữa tươi">Sữa tươi</option>
                <!-- Thêm các loại sữa khác nếu có -->
            </select>

            <label for="hang_sua">Hãng sữa:</label>
<select id="hang_sua" name="hang_sua">
    <option value="">Chọn hãng sữa</option>
    <option value="Vinamilk">Vinamilk</option>
    <option value="TH">TH True Milk</option>
    <option value="Mộc Châu">Mộc Châu</option>
    <option value="Nutifood">Nutifood</option>
    <option value="Dutch Lady">Dutch Lady</option>
    <option value="Nestle">Nestle</option>
    <option value="Friso">Friso</option>
    <option value="Dumex">Dumex</option>
    <option value="Abbott">Abbott</option>
</select>



                <!-- Thêm các hãng sữa khác nếu có -->
            </select>

            <input type="submit" value="Tìm kiếm">
        </form>
    </div>

    <div class="product-container">
        <?php
        if (isset($_GET['ten_sua']) || isset($_GET['loai_sua']) || isset($_GET['hang_sua'])) {
            // Kết nối tới cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "ql_ban_sua");
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Xây dựng truy vấn SQL
            $ten_sua = isset($_GET['ten_sua']) ? $conn->real_escape_string($_GET['ten_sua']) : '';
            $loai_sua = isset($_GET['loai_sua']) ? $conn->real_escape_string($_GET['loai_sua']) : '';
            $hang_sua = isset($_GET['hang_sua']) ? $conn->real_escape_string($_GET['hang_sua']) : '';

            $sql = "SELECT * FROM products WHERE 1=1";

            // Thêm điều kiện tìm kiếm nếu người dùng nhập vào
            if ($ten_sua != '') {
                $sql .= " AND ten_sua LIKE '%$ten_sua%'";
            }
            if ($loai_sua != '') {
                $sql .= " AND loai_sua = '$loai_sua'";
            }
            if ($hang_sua != '') {
                $sql .= " AND hang_sua = '$hang_sua'";
            }

            // Thực hiện truy vấn
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<p><strong>Có " . $result->num_rows . " sản phẩm được tìm thấy</strong></p>";

                // Hiển thị từng sản phẩm
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
                echo "<p><strong>Không tìm thấy sản phẩm này.</strong></p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
