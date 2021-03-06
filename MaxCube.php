<?php

namespace particleflux\MaxCube;


use particleflux\MaxCube\messages\Message;
use particleflux\MaxCube\messages\MessageH;
use particleflux\MaxCube\messages\MessageL;
use particleflux\MaxCube\models\Cube;


class MaxCube
{
    const DEFAULT_PORT = 62910;

    private $ipAddress;
    private $port;
    private $socket;

    /** @var  Cube */
    private $cube;

    public function __construct($ipAddress, $port = self::DEFAULT_PORT)
    {
        $this->ipAddress = $ipAddress;
        $this->port = $port;
    }

    public function connect()
    {
        if (!is_resource($this->socket)) {
            $this->socket = fsockopen($this->ipAddress, $this->port);
        }

        // read initial stuff
        while ($line = fgets($this->socket)) {
            $incoming = Message::instantiate(rtrim($line));
            $this->handleMessage($incoming);
            if ($incoming instanceof MessageL) {
                break;
            }
        }
    }

    public function getCube()
    {
        return $this->cube;
    }

    /**
     * @param Message $incoming
     */
    private function handleMessage($incoming)
    {
        $messageClass = get_class($incoming);
        switch ($messageClass) {
            case MessageH::class:
                $this->cube = $incoming->parse();
                break;
            case MessageL::class:
                $this->cube->devices = $incoming->parse();
                break;
        }
    }

}
