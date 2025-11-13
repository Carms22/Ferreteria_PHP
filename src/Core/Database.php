<?php
namespace Core;
require_once __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;
use PDO;
use PDOException;
use RuntimeException;

class Database {
    private static ?PDO $pdo = null;

    // Cargar .env solo una vez
    private static function cargarArchivoEnv(): void {
        static $loaded = false;
        if (!$loaded) {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            $loaded = true;
        }
    }

    // Conectar a la BD
    public static function connect(): ?PDO {
        if (self::$pdo !== null) {
            return self::$pdo; // Ya conectada
        }

        self::cargarArchivoEnv();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            self::$pdo = new PDO($dsn, $user, $pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$pdo;
        } catch (PDOException $e) {
            throw new RuntimeException("Error de conexión: " . $e->getMessage());
        }
    }

    // Desconectar
    public static function disconnect(): void {
        self::$pdo = null;
    }
}