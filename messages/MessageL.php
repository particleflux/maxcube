<?php

namespace particleflux\MaxCube\messages;


use particleflux\MaxCube\models\Device;

class MessageL extends Message
{
    const BIT_MASK_MODE        = 0b00000011;
    const BIT_MASK_DST         = 0b00001000;
    const BIT_MASK_GATEWAY     = 0b00010000;
    const BIT_MASK_PANEL       = 0b00100000;
    const BIT_MASK_LINK_STATUS = 0b01000000;
    const BIT_MASK_BATTERY     = 0b10000000;


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
        $flag2 = ord($subMessage[6]);

        $device->mode           = $flag2 & self::BIT_MASK_MODE;
        $device->isDst          = ($flag2 & self::BIT_MASK_DST) > 0;
        $device->isGatewayKnown = ($flag2 & self::BIT_MASK_GATEWAY) > 0;
        $device->isPanelLocked  = ($flag2 & self::BIT_MASK_PANEL) > 0;
        $device->isLinkError    = ($flag2 & self::BIT_MASK_LINK_STATUS) > 0;
        $device->isBatteryLow   = ($flag2 & self::BIT_MASK_BATTERY) > 0;

        if ($length > 6) {
            $device->valvePosition = ord($subMessage[7]);
            $device->temperature = (ord($subMessage[8]) & 0b111111) / 2;
        }

        return $device;
    }
}