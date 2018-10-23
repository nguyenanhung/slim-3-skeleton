<?php
/**
 * Project testSlim.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/20/18
 * Time: 16:05
 */

namespace App;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AppController
{
    /** @var object \Psr\Container\ContainerInterface */
    protected $container;
    /** @var object DB PDO */
    protected $db;
    /** @var object Log */
    protected $logger;

    /**
     * ApiController constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db        = $this->container->db;
        $this->logger    = $this->container->logger;
    }

    /**
     * Function test
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 10:47
     *
     * @param \Slim\Http\Request  $request
     * @param \Slim\Http\Response $response
     *
     * @return \Slim\Http\Response
     */
    public function test(Request $request, Response $response)
    {
        $params = $request->getQueryParams();

        return $response->withJson($params);
    }
}
