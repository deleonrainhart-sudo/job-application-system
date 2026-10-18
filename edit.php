<?php
require_once 'config/database.php';
require_once 'classes/Application.php';

$app = new Application($pdo);
$id = $_GET['id'] ?? 0;
$row = $app->getById($id);

if (!$row) {
    header("Location: index.php?msg=" . urlencode("Record not found."));
    exit;
}
$statuses = ['Pending', 'Interview', 'Hired', 'Rejected'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Application</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>Edit Application #<?= $row['id'] ?></h1>
    <div class="card">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="form-grid">
                <div><label>First Name</label><input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required></div>
                <div><label>Last Name</label><input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required></div>
                <div><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required></div>
                <div><label>Contact Number</label><input type="text" name="contact_number" value="<?= htmlspecialchars($row['contact_number']) ?>" required></div>
                <div><label>Position Applied</label><input type="text" name="position_applied" value="<?= htmlspecialchars($row['position_applied']) ?>" required></div>
                <div><label>Main Language</label><input type="text" name="main_language" value="<?= htmlspecialchars($row['main_language']) ?>" required></div>
                <div><label>Years of Experience</label><input type="number" name="years_experience" min="0" value="<?= (int)$row['years_experience'] ?>" required></div>
                <div><label>Portfolio Link</label><input type="text" name="portfolio_link" value="<?= htmlspecialchars($row['portfolio_link'] ?? '') ?>"></div>
                <div>
                    <label>Status</label>
                    <select name="status">
                        <?php foreach ($statuses as $s): ?>
                            <option <?= $row['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-cancel">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
