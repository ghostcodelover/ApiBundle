<?php
/**
 * Created by PhpStorm.
 * User: localgit
 * Date: 3/7/17
 * Time: 2:30 PM
 */

namespace ZND\SIM\ApiBundle\Handler;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiHandler
 *
 * @package ZND\SIM\ApiBundle\Handler
 * @DI\Service("events_api.api_view_handler")
 */
abstract class ApiHandler
{
    /**
     * @var ViewHandlerInterface
     * @DI\Inject("fos_rest.view_handler")
     */
    public $viewHandler;

    /**
     * Creates a view.
     *
     * Convenience method to for a fluent interface.
     *
     * @param mixed $data
     * @param int   $statusCode
     * @param array $headers
     *
     * @return View
     */
    protected function view($data = null, $statusCode = null, array $headers = [])
    {
        return View::create($data, $statusCode, $headers);
    }


    /**
     * Creates a Redirect view.
     *
     * Convenience method to allow for a fluent interface.
     *
     * @param string $url
     * @param int    $statusCode
     * @param array  $headers
     *
     * @return View
     */
    protected function redirectView($url, $statusCode = Response::HTTP_FOUND, array $headers = [])
    {
        return View::createRedirect($url, $statusCode, $headers);
    }

    /**
     * Creates a Route Redirect View.
     *
     * Convenience method to allow for a fluent interface.
     *
     * @param string $route
     * @param mixed  $parameters
     * @param int    $statusCode
     * @param array  $headers
     *
     * @return View
     */
    protected function routeRedirectView($route, array $parameters = [], $statusCode = Response::HTTP_CREATED, array $headers = [])
    {
        return View::createRouteRedirect($route, $parameters, $statusCode, $headers);
    }

    /**
     * Converts view into a response object.
     *
     * Not necessary to use, if you are using the "ViewResponseListener", which
     * does this conversion automatically in kernel event "onKernelView".
     *
     * @param View $view
     *
     * @return Response
     */
    protected function handleView(View $view)
    {
        return $this->viewHandler->handle($view);
    }
}