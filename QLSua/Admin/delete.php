<?php
include '../connect.php';

if (!empty($_POST)) {
    try {
        $id = $_POST["id"];

        $stmt = $conn->prepare("DELETE FROM Sua WHERE id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                ?>
                <script>
                    window.location.href = `dashboard.php?route=listProduct.php&code=0`; 
                </script>
                <?php
            }
        }

        $stmt->close();
    } catch (Throwable $th) {
        ?>
        <script>
            window.location.href = `dashboard.php?route=listProduct.php&code=1`; 
        </script>
        <?php
    }
} else {
    ?>
    <script>
        window.location.href = `index.php?code=1`; 
    </script>
    <?php
}
?>