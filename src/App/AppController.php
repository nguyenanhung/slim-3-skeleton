<?php
/**
 * Project testSlim.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/20/18
 * Time: 16:05
 */

namespace App;

use App\Library\BaseModel;
use App\Library\Config;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AppController
 *
 * @package   App
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class AppController
{
    /** @var object \Psr\Container\ContainerInterface */
    protected $container;
    /** @var object DB PDO */
//    protected $db;
    /** @var object Log */
    protected $logger;

    /**
     * ApiController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
//        $this->db = $this->container->db;
        $this->logger = $this->container->logger;
    }

    /**
     * Function test
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 10:47
     *
     */
    public function test(Request $request, Response $response)
    {
        $this->logger->info(__FUNCTION__);
        $params = $request->getQueryParams();
        $params['version'] = VERSION;
        return $response->withJson($params);
    }

    public function json(Request $request, Response $response)
    {
        $this->logger->info(__FUNCTION__);
        $params = $request->getQueryParams();
        $params['version'] = VERSION;
        $params['method'] = $request->getMethod();
        $params['path'] = '/api/v1/test';
        return $response->withJson($params);
    }
}
