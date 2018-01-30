<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Controller;

use Metinet\Core\Dependencies\ControllerDependencies;
use Metinet\Core\Http\Request;
use Metinet\Core\Routing\UrlMatcher;

class ControllerResolver
{
    private $urlMatcher;
    private $controllerDependencies;

    public function __construct(UrlMatcher $matcher, ControllerDependencies $controllerDependencies)
    {
        $this->urlMatcher = $matcher;
        $this->controllerDependencies = $controllerDependencies;
    }

    public function resolve(Request $request): callable
    {
        $action = $this->urlMatcher->match($request);

        [$controller, $method] = explode('::', $action);
        $controller = strtr($controller, ':', '\\');

        if (!class_exists($controller)) {

            throw UnableToResolveController::controllerNotFound($controller);
        }

        $controllerInstance = new $controller($this->controllerDependencies);

        if (!method_exists($controllerInstance, $method)) {

            throw UnableToResolveController::actionNotFoundInController($method, $controller);
        }

        return [$controllerInstance, $method];
    }
}
