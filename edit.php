<?php
include('config.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("UPDATE records SET name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM records WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$contact = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Contact</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Edit Contact</h1>
  <form method="POST" action="edit.php?id=<?php echo $id; ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required><br>
    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required><br>
    <button type="submit">Update</button>
  </form>
  <p><a href="index.php">Back to List</a></p>
</body>
</html>
