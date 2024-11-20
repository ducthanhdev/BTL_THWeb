<?php
include '../connect.php';
if (!empty($_POST)) {
    try {
        $sql = "UPDATE Sua SET title = ?, thumbnail = ?, weight = ?, price = ?, content = ?, is_active = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $title = $_POST["title"];
        $thumbnail = $_POST["thumbnail"];
        $weight = $_POST["weight"];
        $content = $_POST["content"];
        $is_active = $_POST["is_active"] != "Ẩn";
        $id = $_POST["id"];
        $price = $_POST["price"];

        $stmt->bind_param("ssssssi", $title, $thumbnail, $weight, $price, $content, $is_active, $id);

        if ($stmt->execute()) {
            ?>
            <script>
                window.location.href = `dashboard.php?route=listProduct.php&code=0`; 
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