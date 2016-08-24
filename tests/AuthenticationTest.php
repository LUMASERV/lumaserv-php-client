<?php

use LumaservSystems\LUMASERV;

class AuthenticationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \LumaservSystems\Exception\MalformedParameterException
     */
    public function testExceptionIsThrownIfBadParamsPassed() {
        $lumaserv = new LUMASERV([
            'username' => '10001',
            'password' => ''
        ]);
    }

}