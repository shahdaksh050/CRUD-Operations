<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO records (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Contact</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Add Contact</h1>
  <form method="POST" action="add.php">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>
    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required><br>
    <button type="submit">Save</button>
  </form>
  <p><a href="index.php">Back to List</a></p>
</body>
</html>
