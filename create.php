<?php
require 'db/db_Connection.php'; // Connect to the database

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    // Check that the title is not empty
    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO books (title, author, year) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $author, $year);

        if ($stmt->execute()) {
            header("Location: index.php"); // Redirect after successful insert
            exit();
        } else {
            echo "<p class='text-danger'>❌ Error while adding: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p class='text-danger'>⚠️ Title is required.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<?php include 'include/navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">📚 Add a New Book</h2>
    <form action="create.php" method="POST" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Book Title *</label>
            <input type="text" name="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" name="author" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Publication Year</label>
            <input type="number" name="year" class="form-control" />
        </div>
        <button type="submit" class="btn btn-success">➕ Add</button>
        <a href="index.php" class="btn btn-secondary">🔙 Back</a>
    </form>
</div>

<?php include 'include/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
