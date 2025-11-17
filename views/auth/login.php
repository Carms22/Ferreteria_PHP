<?php
require_once __DIR__ . "/../../src/Core/Database.php";
require_once __DIR__ . "/../../src/Core/Auth.php";

use Core\Database;
use Core\Auth;


// Obtén la conexión directamente
$pdo = Database::connect();

// Crea el objeto Auth con la conexión
$auth = new Auth($pdo);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $pass  = $_POST['pass'] ?? '';
    var_dump($email, $pass);//me salen los valores correctos, se pasa por post
    
    if ($auth->login($email, $pass)) {
        $page = "catalog/landing";
        $file = __DIR__ . "/../../views/" . $page . ".php";
        include $file;
        exit;
    }
    else {
            $error = "Credenciales incorrectas";
        }
}
?>

<form class="column" method="post" action="index.php?page=auth/login">
    <label for="email">Email</label>
    <input id="email" name="email" type="email" required>
    <label for="pass">Password</label>
    <input id="pass" name="pass" type="password" required>
    <button type="submit" id="login" class="login">Login</button>
</form>