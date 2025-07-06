<?php
require 'db/db_Connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "<p class='text-danger'>Delete failed: " . $conn->error . "</p>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
