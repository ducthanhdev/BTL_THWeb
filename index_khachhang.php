<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "QL_BAN_SUA");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu
$sql = "SELECT * FROM KHACH_HANG";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin khách hàng</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }
        .odd { background-color: #f9f9f9; }
        .even { background-color: #e0e0e0; }
        .center { text-align: center; }
        .gender-icon {
            text-align: center;
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <h2>Danh sách khách hàng</h2>
    <table>
        <tr>
            <th>Mã khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $index = 0;
            while($row = $result->fetch_assoc()) {
                $class = ($index % 2 == 0) ? 'even' : 'odd';
                echo "<tr class='{$class}'>";
                echo "<td>".$row["Ma_khach_hang"]."</td>";
                echo "<td>".$row["Ten_khach_hang"]."</td>";
                echo "<td>";
                if ($row["Gioi_tinh"] == "Nam") {
                    echo "<img src='man.png' class='gender-icon' alt='Nam'>";
                } else {
                    echo "<img src='woman.png' class='gender-icon' alt='Nữ'>";
                }
                echo "</td>";
                echo "<td>".$row["Dia_chi"]."</td>";
                echo "<td>".$row["Dien_thoai"]."</td>";
                echo "</tr>";
                $index++;
            }
        } else {
            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
