<?php
require 'db/db_Connection.php';

// Check if ID is passed
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$book = null;

// Fetch book info
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $book = $result->fetch_assoc();
} else {
    echo "<p class='text-danger'>Book not found.</p>";
    exit();
}

// Update book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    if (!empty($title)) {
        $update = $conn->prepare("UPDATE books SET title=?, author=?, year=? WHERE id=?");
        $update->bind_param("ssii", $title, $author, $year, $id);
        if ($update->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "<p class='text-danger'>Update failed: " . $conn->error . "</p>";
        }
    } else {
        echo "<p class='text-danger'>Title is required.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<?php include 'include/navbar.php'; ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">✏️ Edit Book</h2>
  <form method="POST" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label class="form-label">Title *</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($book['title']) ?>" required />
    </div>
    <div class="mb-3">
      <label class="form-label">Author</label>
      <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($book['author']) ?>" />
    </div>
    <div class="mb-3">
      <label class="form-label">Year</label>
      <input type="number" name="year" class="form-control" value="<?= htmlspecialchars($book['year']) ?>" />
    </div>
    <button type="submit" class="btn btn-primary">💾 Save Changes</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php include 'include/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
