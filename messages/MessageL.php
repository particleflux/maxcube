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

        for ($pos = 0, $end = strlen($line) - 1; $pos < $end ; ) {
            $length = ord($line[$pos]);
            $subMessage = substr($line, $pos, $length + 1);
            $devices[] = $this->parseSubMessage($subMessage);
            $pos += $length + 1;
        }



        return $devices;
    }

    private function parseSubMessage($subMessage)
    {
        $device = new Device();
        $device->rfAddress = unpack('H*', substr($subMessage, 1, 3));
        $device->mode = ord($subMessage[6]) & self::MODE_BIT_MASK;

        return $device;
    }
}