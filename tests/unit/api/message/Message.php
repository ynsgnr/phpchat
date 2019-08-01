<?php
use PHPUnit\Framework\TestCase;

require_once('api/user/Message.php');
require_once('api/config/User.php');

class Message_Test extends TestCase
{
    private $message;

    public function testConstructEmpty()
    {
        $this->expectException(ArgumentCountError::class);
        $this->user = new Message();
    }
    
    public function testConstruct()
    {
        $db = new Database();
        $this->message = new User($db->connect2database());
        $this->assertInstanceOf(Message::class, $this->message);
    }

    /**
     * @depends testConstruct
     */
    public function testCrateSession()
    {
        $db = new Database();
        $this->message = new User($db->connect2database());
        $this->expectException(InvalidArgumentException::class);
        $this->message->send()
    }
}