<?php
use PHPUnit\Framework\TestCase;

require_once('api/message/Message.php');
require_once('api/config/Database.php');

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
        $this->message = new Message($db->connect2database());
        $this->assertInstanceOf(Message::class, $this->message);
    }

    /**
     * @depends testConstruct
     */
    public function testSend()
    {
        $db = new Database();
        $this->message = new Message($db->connect2database());
        $this->expectException(InvalidArgumentException::class);
        $this->message->send();
    }

    /**
     * @depends testConstruct
     */
    public function testSendWithValues()
    {
        $db = new Database();
        $this->message = new Message($db->connect2database());
        $this->message->sender = 1;
        $this->message->reciever = 7;
        $this->assertIsNumeric($this->message->send());
    }
}