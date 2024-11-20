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
        $id = $_POST["Id"];
        $stmt = $conn->prepare("DELETE FROM Product WHERE Id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                ?>
                <script>
                    window.location.href = `dashboard.php?route=listSuaSix.php&code=0`; 
                </script>
                <?php
            }
        }

        $stmt->close();
    } catch (Throwable $th) {
        ?>
        <script>
            window.location.href = `dashboard.php?route=listSuaSix.php&code=1`; 
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