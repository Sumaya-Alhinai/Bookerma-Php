# 📚 Bookerma - Book Management Web App

**Bookerma** is a simple PHP-based web application to manage a list of books.
It allows users to **add**, **view**, **edit**, **delete**, and **hide/show** books dynamically.

---

##  Features

- ✅ Add new books with title, author, and year.
- 📝 Edit existing book details.
- ❌ Delete books from the database.
- 👁 Hide/show individual book cards using checkboxes.
- 👁‍🗨 "Show All Books" button to make hidden books visible again.
- 🧠 Clean and responsive Bootstrap design.
- 🗃 MySQL database connection with secure queries.

---

## 📁 Folder Structure


bookerma/

├── db/

│ ├── db_Connection.php # Database connection file

│ └── db_bookerma.sql # SQL structure for books table

├── index.php # Main page to view and manage books

├── create.php # Form to add a new book

├── edit.php # Form to update book info

├── delete.php # Script to delete book

├── include/

│ ├── navbar.php # Reusable top navigation bar

  └── footer.php # Reusable footer
