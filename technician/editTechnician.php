<?php
require_once __DIR__ . '/../data/db.php';
$techID = $_GET['techID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $sql = 'UPDATE technicians SET firstName = ?, lastName = ?, email = ?, password = ?, phone = ? WHERE techID = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$firstName, $lastName, $email, $password, $phone, $techID]);

    header('Location: techManager.php');
    exit();
}

$stmt = $db->prepare('SELECT * FROM technicians WHERE techID = ?');
$stmt->execute([$techID]);
$technician = $stmt->fetch();

if (!$technician) {
    echo "Technician not found.";
    exit();
}
?>

<body style="background-color: #e0e7ff; margin: 0; padding: 0;">
<div style="max-width: 1100px; min-height: 600px; margin: 40px auto; background-color: white; padding: 40px 50px; border: 1px solid #aaa; box-sizing: border-box;">

<h1 style="margin-top: 20px;">SportsPro Technical Support</h1>
<p>Sports management software for sports enthusiasts</p>
<p><a href="../index.php" style="font-weight: bold; color: #0000EE; text-decoration: underline;">Home</a></p>

<hr style="height: 3px; background-color: black; border: none;">

<h2 style="margin-top: 20px;">Edit Technician</h2>

<form method="post">
    <table style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <td style="padding: 8px;"><label for="firstName" style="font-weight: bold;">First Name:</label></td>
            <td style="padding: 8px;"><input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($technician['firstName']) ?>" style="width: 250px; padding: 4px;" required></td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="lastName" style="font-weight: bold;">Last Name:</label></td>
            <td style="padding: 8px;"><input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($technician['lastName']) ?>" style="width: 250px; padding: 4px;" required></td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="email" style="font-weight: bold;">Email:</label></td>
            <td style="padding: 8px;"><input type="email" name="email" id="email" value="<?= htmlspecialchars($technician['email']) ?>" style="width: 350px; padding: 4px;" required></td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="password" style="font-weight: bold;">Password:</label></td>
            <td style="padding: 8px;"><input type="text" name="password" id="password" value="<?= htmlspecialchars($technician['password']) ?>" style="width: 250px; padding: 4px;" required></td>
        </tr>
        <tr>
            <td style="padding: 8px;"><label for="phone" style="font-weight: bold;">Phone:</label></td>
            <td style="padding: 8px;"><input type="text" name="phone" id="phone" value="<?= htmlspecialchars($technician['phone']) ?>" style="width: 250px; padding: 4px;" required></td>
        </tr>
        <tr>
            <td></td>
            <td style="padding: 8px;"><button type="submit" style="padding: 4px 10px;">Update Technician</button></td>
        </tr>
    </table>
</form>

<p><a href="techManager.php" style="font-weight: bold; color: #0000EE; text-decoration: underline;">Back to Technicians</a></p>

<hr style="height: 3px; background-color: black; border: none;">
<footer style="text-align: right; font-size: 0.9em; color: #333;">
  &copy; 2025 SportsPro, Inc.
</footer>
</div>
</body>
