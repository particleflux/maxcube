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
            $devices[] = $this->parseSubMessage($subMessage, $length);
            $pos += $length + 1;
        }

        return $devices;
    }

    private function parseSubMessage($subMessage, $length)
    {
        $device = new Device();
        $device->rfAddress = unpack('H*', substr($subMessage, 1, 3))[1];
        $device->mode = ord($subMessage[6]) & self::MODE_BIT_MASK;

        if ($length > 6) {
            $device->valvePosition = ord($subMessage[7]);
            $device->temperature = (ord($subMessage[8]) & 0b111111) / 2;
        }

        return $device;
    }
}