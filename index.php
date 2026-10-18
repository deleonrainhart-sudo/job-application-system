<?php
require_once 'config/database.php';
require_once 'classes/Application.php';

$app = new Application($pdo);
$applications = $app->getAll();
$message = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Application System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>Job Application Form - Software Engineer (Web Developer)</h1>

    <?php if ($message): ?>
        <div class="msg"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="card">
        <h2>Apply Now</h2>
        <form action="insert.php" method="POST">
            <div class="form-grid">
                <div><label>First Name</label><input type="text" name="first_name" required></div>
                <div><label>Last Name</label><input type="text" name="last_name" required></div>
                <div><label>Email</label><input type="email" name="email" required></div>
                <div><label>Contact Number</label><input type="text" name="contact_number" required></div>
                <div><label>Position Applied</label><input type="text" name="position_applied" value="Web Developer" required></div>
                <div><label>Main Language</label><input type="text" name="main_language" placeholder="e.g. PHP, JavaScript" required></div>
                <div><label>Years of Experience</label><input type="number" name="years_experience" min="0" value="0" required></div>
                <div><label>Portfolio Link</label><input type="text" name="portfolio_link" placeholder="https://..."></div>
                <div>
                    <label>Status</label>
                    <select name="status">
                        <option>Pending</option>
                        <option>Interview</option>
                        <option>Hired</option>
                        <option>Rejected</option>
                    </select>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>

    <div class="card">
        <h2>All Applications</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Position</th>
                    <th>Language</th><th>Exp.</th><th>Portfolio</th><th>Status</th><th>Date Added</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($applications)): ?>
                <tr><td colspan="11">No applications yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($applications as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['contact_number']) ?></td>
                    <td><?= htmlspecialchars($row['position_applied']) ?></td>
                    <td><?= htmlspecialchars($row['main_language']) ?></td>
                    <td><?= (int)$row['years_experience'] ?> yr(s)</td>
                    <td><?= htmlspecialchars($row['portfolio_link'] ?? '') ?></td>
                    <td><span class="badge"><?= htmlspecialchars($row['status']) ?></span></td>
                    <td><?= $row['date_added'] ?></td>
                    <td class="actions">
                        <a class="btn btn-edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <form action="delete.php" method="POST" onsubmit="return confirm('Delete this application?');">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
