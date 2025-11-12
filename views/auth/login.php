<?php
session_start();
require_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Core/Auth.php";

use Core\Database;
use Core\Auth;

$pdo = (new Database())->getConnection();
$auth = new Auth($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $pass  = $_POST['pass'] ?? '';

    if ($auth->login($email, $pass)) {
        header("Location: ../../public/index.php");
        exit;
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<form class="column" method="post" action="login.php">
    <label for="email">Email</label>
    <input id="email" name="email" type="email" required>

    <label for="pass">Password</label>
    <input id="pass" name="pass" type="password" required>

    <button type="submit" id="login" class="login">Login</button>
</form>