<?php
require_once 'config/database.php';
require_once 'classes/Application.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app = new Application($pdo);
    $app->delete((int)$_POST['id']);
}
header("Location: index.php?msg=" . urlencode("Application deleted."));
exit;
