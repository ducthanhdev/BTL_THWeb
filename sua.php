<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "QL_BAN_SUA";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Đếm tổng số bản ghi trong bảng SUA
$totalItemsResult = $conn->query("SELECT COUNT(*) AS total FROM SUA");
if ($totalItemsResult) {
    $totalItemsRow = $totalItemsResult->fetch_assoc();
    $totalItems = $totalItemsRow['total'];
} else {
    die("Lỗi truy vấn: " . $conn->error);
}

// Sử dụng class Pager
include 'Pager.php';
$pager = new Pager($totalItems, 5);  // Mỗi trang có 5 dòng
$startIndex = $pager->getStartIndex();
$itemsPerPage = 5; // hoặc $pager->itemsPerPage nếu thuộc tính này là public

// Truy vấn dữ liệu
$sql = "SELECT * FROM SUA LIMIT $startIndex, $itemsPerPage";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin sữa</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        .h2 {
            text-align: center;
            color: #ff4d88;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #d2691e;
            color: white;
        }
        /* Dòng chẵn */
        tr:nth-child(even) {
            background-color: #fff;
            color: red;
        }
        /* Dòng lẻ */
        tr:nth-child(odd) {
            background-color: #FCAF4A;
            
        }
        tr:hover {background-color: #ddd;}
        .pagination {
            text-align: center;
            margin-top: 10px;
        }
        .pagination a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #ddd;
            margin: 0 3px;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Danh sách các sản phẩm sữa</h2>
    <table>
        <tr>
            <th>Mã sữa</th>
            <th>Tên sữa</th>
            <th>Hãng sữa</th>
            <th>Loại sữa</th>
            <th>Trọng lượng</th>
            <th>Giá (VNĐ)</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Ma_sua"] . "</td>";
                echo "<td>" . $row["Ten_sua"] . "</td>";
                echo "<td>" . $row["Hang_sua"] . "</td>";
                echo "<td>" . $row["Loai_sua"] . "</td>";
                echo "<td>" . $row["Trong_luong"] . "g</td>";
                echo "<td>" . number_format($row["Gia"], 0, ',', '.') . " VNĐ</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>

    <div style="text-align: center;">
        <?php
        $pager->displayPageNumbers();
        echo "<br>";
        $pager->displayNavigation();
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
