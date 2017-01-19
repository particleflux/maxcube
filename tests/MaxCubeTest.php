<?php

namespace particleflux\MaxCube {

    /**
     * Fake fsockopen function
     *
     * @return resource
     */
    function fsockopen()
    {
        $stream = fopen('php://memory','rb+');
        fwrite($stream, 'H:KEQ0643784,09e4f5,0113,00000000,2bb2a0f3,00,32,11010b,143a,03,0000
M:00,01,VgIBAQNCYWQVCuIBARUK4k1FUTE4MTU1ODkMVGhlcm1vc3RhdCAxAQE=
C:09e4f5,7Qnk9QATAf9LRVEwNjQzNzg0AAsABEAAAAAAAAAAAP///////////////////////////wsABEAAAAAAAAAAQf///////////////////////////2h0dHA6Ly9tYXguZXEtMy5kZTo4MC9jdWJlADAvbG9va3VwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAENFVAAACgADAAAOEENFU1QAAwACAAAcIA==
C:150ae2,0hUK4gEBEKBNRVExODE1NTg5LCE9CQcYAzAM/wBESFUIRSBFIEUgRSBFIEUgRSBFIEUgRSBFIERIVQhFIEUgRSBFIEUgRSBFIEUgRSBFIEUgREhUbETMVRRFIEUgRSBFIEUgRSBFIEUgRSBESFRsRMxVFEUgRSBFIEUgRSBFIEUgRSBFIERIVGxEzFUURSBFIEUgRSBFIEUgRSBFIEUgREhUbETMVRRFIEUgRSBFIEUgRSBFIEUgRSBESFRsRMxVFEUgRSBFIEUgRSBFIEUgRSBFIA==
L:CxUK4gkSGWQ9AK8A
'
        );
        rewind($stream);
        return $stream;
    }

}


namespace particleflux\MaxCube\tests {


    use particleflux\MaxCube\MaxCube;
    use particleflux\MaxCube\messages\MessageH;
    use particleflux\MaxCube\messages\MessageL;


    class MaxCubeTest extends TestCase
    {

        public function testHandleMsg()
        {
            $cube     = new MaxCube('127.0.0.1', 0);
            $messageH = new MessageH('KEQ0643784,09e4f5,0113,00000000,2bb2a0f3,00,32,11010b,143a,03,0000');
            $this->invokeMethod($cube, 'handleMessage', [$messageH]);
            $this->assertEquals($cube->getCube(), $messageH->parse());

            $messageL = new MessageL('Cw/a7QkSGBgoAMwACw/DcwkSGBgoAM8ACw/DgAkSGBgoAM4A');
            $this->invokeMethod($cube, 'handleMessage', [$messageL]);
            $this->assertEquals($cube->getCube()->devices, $messageL->parse());
        }

        public function testConnect()
        {
            $cube = new MaxCube('127.0.0.1', 0);
            $cube->connect();

            $messageL = new MessageL('CxUK4gkSGWQ9AK8A');
            $this->assertEquals($cube->getCube()->devices, $messageL->parse());
        }
    }
}