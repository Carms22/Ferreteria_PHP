<?php
namespace Core;
use PDO;

/**
 * Clase Auth
 * Maneja la autenticación de usuarios
 */
class Auth{
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
        $sql ="SELECT * FROM ferreterias WHERE Correo = :email";
        $stmt = $this->pdo->prepare($sql);//evita inyecciones sql
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        //var_dump($user);
        if ($user && $pass==$user['Clave']) {
            $_SESSION['user_id']   = $user['CodRes'];
            $_SESSION['user_name'] = $user['Nombre'];
            $_SESSION['user_email'] = $user['Correo'];
            return true;
        }
        return false;
    }
    /**
     * Verificar si el usuario está autenticado
     */
    public function isAuthenticated(): bool {
        return isset($_SESSION['user_id']);
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(): void {
        session_destroy();
    }
}
