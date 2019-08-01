<?php
use PHPUnit\Framework\TestCase;

require_once('api/config/Database.php');

class Database_Test extends TestCase
{
    private $database;

    public function testEnvValues(){
        $this->assertIsString(getenv("DB_HOST"));
        $this->assertIsString(getenv("DB_NAME"));
        $this->assertIsString(getenv("DB_USER"));
        $this->assertIsString(getenv("DB_PASS"));
    }

    /**
     * @depends testEnvValues
     */
    public function testConstruct()
    {
        $this->database = new Database();
        $this->assertInstanceOf(Database::class, $this->database);
    }

    /**
     * @depends testConstruct
     */
    public function testConnection()
    {
        $this->database = new Database();
        $this->assertInstanceOf(PDO::class, $this->database->connect2database());
    }
}