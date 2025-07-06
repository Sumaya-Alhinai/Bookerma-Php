<?php
require 'db/db_Connection.php'; // Database connection

$books = []; // Array to store books

// Query to fetch all books ordered by ID descending
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row; // Store each row in the array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bookerma - Manage Books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    /* Hide books */
    .hidden-book {
      display: none !important;
    }

    /* Footer at the bottom */
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1 0 auto;
    }
    footer {
      flex-shrink: 0;
      background-color: #0a4275;
      color: white;
      padding: 1rem 0;
      text-align: center;
    }

    /* Simple logo style */
    .navbar-brand-logo {
      font-weight: bold;
      font-size: 1.5rem;
      color: #0a4275;
      text-decoration: none;
    }
    .navbar-brand-logo:hover {
      text-decoration: none;
      color: #0a4275;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<?php include 'include/navbar.php'; ?>

    <!-- Toggle button for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-success text-white px-3 ms-2" href="create.php">+ Add New Book</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-5">
  <h2 class="text-center mb-4">📚 Book List</h2>

  <!-- Show all books button -->
  <div class="text-center mb-4">
    <button class="btn btn-outline-primary" onclick="showAllBooks()">👁 Show All Books</button>
  </div>

  <!-- Main card containing book cards -->
  <div class="card shadow p-3">
    <div class="card-body">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="booksContainer">
        <?php if(count($books) > 0): ?>
          <?php foreach ($books as $book): ?>
            <div class="col book-card" id="book-<?= $book['id'] ?>">
              <div class="card h-100 shadow-sm position-relative">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
                  <p class="card-text">
                    <strong>Author:</strong> <?= htmlspecialchars($book['author']) ?><br>
                    <strong>Year:</strong> <?= htmlspecialchars($book['year']) ?><br>
                    <strong>Created At:</strong> <?= $book['created_at'] ?>
                  </p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <div>
                    <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-primary">✏️ Edit</a>
                    <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">🗑 Delete</a>
                  </div>
                  <!-- Hide checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" onchange="toggleBookVisibility(<?= $book['id'] ?>)">
                    <label class="form-check-label">Hide</label>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-center text-muted">No books available.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'include/footer.php'; ?>
<!-- JavaScript -->
<script>
  // Toggle visibility of a single book card
  function toggleBookVisibility(bookId) {
    const bookElement = document.getElementById("book-" + bookId);
    const checkbox = event.target;
    if (checkbox.checked) {
      bookElement.classList.add("hidden-book");
    } else {
      bookElement.classList.remove("hidden-book");
    }
  }

  // Show all hidden books and uncheck all hide checkboxes
  function showAllBooks() {
    const hiddenBooks = document.querySelectorAll(".hidden-book");
    hiddenBooks.forEach(book => {
      book.classList.remove("hidden-book");
    });

    const checkboxes = document.querySelectorAll(".form-check-input");
    checkboxes.forEach(cb => cb.checked = false);
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
