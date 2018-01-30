<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Routing;

use Metinet\Core\Http\Request;

interface UrlMatcher
{
    public function match(Request $request);
}
