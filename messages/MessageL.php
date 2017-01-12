<?php

namespace particleflux\MaxCube\messages;


use particleflux\MaxCube\models\Device;

class MessageL extends Message
{
    const MODE_BIT_MASK = 0x03;


    public function parse()
    {
        $devices = [];
        $line = base64_decode($this->rawMessage);
//        $messageLength = ord($line[0]);

        $device = new Device();
        $device->rfAddress = unpack('H*', substr($line, 1, 3));
        $device->mode = ord($line[6]) & self::MODE_BIT_MASK;

        $devices[] = $device;

        return $devices;
    }
}