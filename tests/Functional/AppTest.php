<?php

namespace Tests\Functional;

class AppTest extends BaseTestCase
{
    /**
     * Test App Test is 200
     */
    public function testGetAppTest()
    {
        $response = $this->runApp('GET', '/app/test');
        $this->assertEquals(200, $response->getStatusCode());
    }

}