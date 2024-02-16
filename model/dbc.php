<?php
namespace Uph22si1Web\Todo\Model;
use PDO;
use PDOException;

class dbc
{
    private $host = 'localhost';
    private $username = 'root';
    private $pass = '';
    private $database = 'web';
    private $conn;

    //definisi enum
    const TODO = 0;
    const IN_PROGRESS = 1;
    const DONE = 2;

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->conn = new PDO($dsn, $this->username, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException('Gagal Konek ke Database: ' . $e->getMessage());
        }
    }

    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function state($no): string
    {
        switch ($no) {
            case self::TODO:
                return "To Do";
            case self::IN_PROGRESS:
                return "In Progress";
            case self::DONE:
                return "Done";
            default:
                return "-";
        }
    }
}
?>