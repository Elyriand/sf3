<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Core\Dependencies\ControllerDependencies;
use Metinet\Core\Security\AuthenticationContext;

abstract class Controller
{
    protected $controllerDependencies;

    public function __construct(ControllerDependencies $controllerDependencies)
    {
        $this->controllerDependencies = $controllerDependencies;
    }

    protected function render(string $viewName, array $parameters = []): string
    {
        return $this->controllerDependencies->getViewRenderer()->render($viewName, $parameters);
    }

    protected function getAuthenticationContext(): AuthenticationContext
    {
        return $this->controllerDependencies->getAuthenticationContext();
    }
}
