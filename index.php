<?php
include('config.php');

$sql = "SELECT * FROM records";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD Operation - Contact List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Contact List</h1>
  <p><a href="add.php">Add New Contact</a></p>
  <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li>
        <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
        Email: <?php echo htmlspecialchars($row['email']); ?><br>
        Phone: <?php echo htmlspecialchars($row['phone']); ?><br>
        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this contact?')">Delete</a>
      </li>
      <hr>
    <?php endwhile; ?>
  </ul>
</body>
</html>
