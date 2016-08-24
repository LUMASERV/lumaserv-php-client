<?php

use LumaservSystems\LUMASERV;
use CustomClasses\TestClass;

class AuthenticationTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException \LumaservSystems\Exception\MalformedParameterException
     */
    public function testExceptionIsThrownIfBadParamsPassed() {
        $lumaserv = new LUMASERV([
            'username' => '10001',
            'password' => ''
        ]);
    }

    /**
     * @expectedException  \LumaservSystems\Exception\MalformedParameterException
     */
    public function testExceptionIsThrownWhenWrongCredentialsObjectIsPassed() {
        $lumaserv = new LUMASERV(new TestClass('test', 'test2'));
    }

}