<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";  // Thay bằng username MySQL của bạn
$password = "";      // Thay bằng password MySQL của bạn
$database = "QL_BAN_SUA";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng HANG_SUA
$sql = "SELECT * FROM HANG_SUA";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin hãng sữa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:hover {background-color: #ddd;}
    </style>
</head>
<body>
    <h2>Danh sách các hãng sữa</h2>
    <table>
        <tr>
            <th>Mã hãng sữa</th>
            <th>Tên hãng sữa</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Email</th>
        </tr>
        <?php
        // Kiểm tra và hiển thị dữ liệu
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Ma_hang_sua"] . "</td>";
                echo "<td>" . $row["Ten_hang_sua"] . "</td>";
                echo "<td>" . $row["Dia_chi"] . "</td>";
                echo "<td>" . $row["Dien_thoai"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
