<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 1/11/17
 * Time: 8:02 PM
 */

namespace particleflux\MaxCube\models;

/**
 * Class Device
 * @package particleflux\MaxCube\models
 *
 * Base info for all devices
 */
class Device
{
    const MODE_AUTO     = 0;
    const MODE_MANUAL   = 1;
    const MODE_VACATION = 2;
    const MODE_BOOST    = 3;



    /** @var  string */
    public $rfAddress;

    public $unknown;

    /** @var  int one of the MODE_ constants */
    public $mode;

    /** @var  bool dst state */
    public $isDst;

    /** @var  bool */
    public $isGatewayKnown;

    /** @var  bool */
    public $isPanelLocked;

    /** @var  bool */
    public $isLinkError;

    /** @var  bool */
    public $isBatteryLow;

    /**
     * @var  int valve position
     *
     * 100 is fully open, 0 is closed
     * wall thermostats always return 4
     */
    public $valvePosition;

    /** @var  int configured temperature */
    public $temperature;

    /** @var  int */
    public $wallTemperature;
}