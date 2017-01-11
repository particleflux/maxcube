<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 11/25/16
 * Time: 12:04 AM
 */

namespace particleflux\MaxCube;


use particleflux\MaxCube\messages\Message;
use particleflux\MaxCube\models\Cube;
use particleflux\MaxCube\models\Device;

class MaxCube
{
    const DEFAULT_PORT = 62910;



    private $ipAddress;
    private $socket;
    private $cube;

    public function __construct($ipAddress)
    {
        $this->ipAddress = $ipAddress;

    }

    public function connect()
    {
        if (!is_resource($this->socket)) {
            $this->socket = fsockopen($this->ipAddress, self::DEFAULT_PORT);
        }

        // read initial stuff
        while ($line = fgets($this->socket)) {
            $incoming = Message::instantiate(rtrim($line));
//            if ($incoming instanceof MessageL) {
//                break;
//            }
        }
    }

    public function getCube()
    {
        return $this->cube;
    }


    protected function parseL($line)
    {
        $line = base64_decode($line);
        var_dump(unpack('H*', $line));
        $messageLength = ord($line[0]);
        echo 'L message length ' . $messageLength . "\n";

        $device = new Device();
        $device->rfAddress = unpack('H*', substr($line, 1, 3));
        $device->mode = ord($line[6]) & 3;

        echo 'got device info: ' . json_encode($device) . "\n";

    }
}



require './models/Device.php';
require './models/Cube.php';
$m = new MaxCube('192.168.178.234');
$m->connect();