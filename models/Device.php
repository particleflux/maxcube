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

    /** @var  integer */
    public $flags;

    /** @var  int one of the MODE_ constants */
    public $mode;
}