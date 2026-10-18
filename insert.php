<?php
require_once 'config/database.php';
require_once 'classes/Application.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app = new Application($pdo);
    $app->create([
        ':first_name'       => trim($_POST['first_name']),
        ':last_name'        => trim($_POST['last_name']),
        ':email'            => trim($_POST['email']),
        ':contact_number'   => trim($_POST['contact_number']),
        ':position_applied' => trim($_POST['position_applied']),
        ':main_language'    => trim($_POST['main_language']),
        ':years_experience' => (int)$_POST['years_experience'],
        ':portfolio_link'   => trim($_POST['portfolio_link']),
        ':status'           => $_POST['status'],
    ]);
}
header("Location: index.php?msg=" . urlencode("Application added successfully!"));
exit;
