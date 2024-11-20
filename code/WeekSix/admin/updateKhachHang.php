<?php
include '../connect.php';

session_start();
if (empty($_SESSION['username'])) {
    ?>
    <script>
        window.location.href = `index.php?code=403`; 
    </script>
    <?php
}

if (!empty($_POST)) {
    try {
        $sql = "UPDATE Customer SET FullName = ?, Address = ?, PhoneNumber = ?, Gender = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);

        $FullName = $_POST["FullName"];
        $Address = $_POST["Address"];
        $PhoneNumber = $_POST["PhoneNumber"];
        $Gender = ($_POST["Gender"] == "Nam") ? 1 : 0;
        $Id = $_POST["Id"];

        $stmt->bind_param("sssis", $FullName, $Address, $PhoneNumber, $Gender, $Id);

        if ($stmt->execute()) {
            ?>
            <script>
                window.location.href = `dashboard.php?route=listKhachHang.php&code=0`; 
            </script>
            <?php
        } else {
            echo "Error: " . $stmt->error;
        }

    } catch (Throwable $th) {
        var_dump($th);

    }
}
?>