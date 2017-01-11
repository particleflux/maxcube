<?php

namespace particleflux\MaxCube\messages;

/**
 * Class Message
 * @package particleflux\MaxCube\messages
 *
 * represents a Message
 */
abstract class Message
{
    public $rawMessage;


    public function __construct($rawMessage)
    {
        $this->rawMessage = $rawMessage;
    }

    public static function instantiate($rawMessage)
    {
        $line = rtrim($rawMessage);
        $messageClass = "particleflux\\MaxCube\\messages\\Message" . $line[0];
        if (class_exists($messageClass)) {
            /** @var Message $message */
            return new $messageClass(substr($line, 2));
        }

        echo "unknown message : $line\n";
        return NULL;
    }

    abstract public function parse();

}