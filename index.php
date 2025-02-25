<?php
session_start();

if (!isset($_SESSION['records'])) {
    $_SESSION['records'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? uniqid();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $_SESSION['records'][$id] = ['name' => $name, 'email' => $email, 'phone' => $phone];

    header("Location: index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['records'][$id]);
    header("Location: index.php");
    exit();
}

$editRecord = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editRecord = $_SESSION['records'][$id];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Record CRUD by Daksh</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>CRUD TABLE</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
    <input type="text" name="name" placeholder="Name" required value="<?= $editRecord['name'] ?? '' ?>">
    <input type="email" name="email" placeholder="Email" required value="<?= $editRecord['email'] ?? '' ?>">
    <input type="text" name="phone" placeholder="Phone" required value="<?= $editRecord['phone'] ?? '' ?>">
    <button type="submit"><?= isset($editRecord) ? "Update" : "Add" ?> Record</button>
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($_SESSION['records'] as $id => $record): ?>
        <tr>
            <td><?= $record['name'] ?></td>
            <td><?= $record['email'] ?></td>
            <td><?= $record['phone'] ?></td>
            <td>
                <a href="?edit=<?= $id ?>">Edit</a>
                <a href="?delete=<?= $id ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
