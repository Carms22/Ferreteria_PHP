<?php
namespace Core;

use PDO;

/**
 * Clase Auth
 * Maneja la autenticación de usuarios
 */
class Auth
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Intenta autenticar un usuario
     *
     * @param string $email
     * @param string $pass
     * @return bool
     */
    public function login(string $email, string $pass): bool {
        $stmt = $this->pdo->prepare("SELECT * FROM ferreterias WHERE Correo = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['Clave'])) {
            $_SESSION['user_id']   = $user['CodRes'];
            $_SESSION['user_name'] = $user['Nombre'];
            $_SESSION['user_role'] = $user['Rol'];
            return true;
        }
        return false;
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(): void {
        session_destroy();
    }
}
