<?php

namespace Slim3SkeletonTests\Functional;

/**
 * Class AppTest
 *
 * @package Slim3SkeletonTests\Functional
 */
class AppTest extends BaseTestCase
{
    /**
     * Test Get /app/test is http code 200
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/24/18 00:36
     *
     * @throws \Throwable
     */
    public function testGetAppTest()
    {
        $response = $this->runApp('GET', '/app/test');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Function testGetAppDbTest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 16:28
     *
     * @throws \Throwable
     */
    public function testGetAppDbTest()
    {
        $response = $this->runApp('GET', '/app/testDb');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test that the /app/test route won't accept a post request
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/24/18 00:35
     *
     * @throws \Throwable
     */
    public function testPostAppTestNotAllowed()
    {
        $response = $this->runApp('POST', '/app/test', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string) $response->getBody());
    }

}