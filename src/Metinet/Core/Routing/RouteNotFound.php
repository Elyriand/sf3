<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Routing;

class RouteNotFound extends \Exception
{
    public function __construct(string $method, string $path)
    {
        parent::__construct(sprintf('No route found for path "%s" with method "%s"', $path, $method));
    }
}
