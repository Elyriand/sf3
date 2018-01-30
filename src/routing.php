<?php

use Metinet\Core\Route;

$routes = [];
$routes[] = new Route(['GET'], '/hello', 'sayHello');
$routes[] = new Route(['GET'], '/students', 'retrieveMemberList');
$routes[] = new Route(['GET'], '/candidates', 'retrieveMemberList');
$routes[] = new Route(['GET'], '/students/sponsor', 'retrieveMemberList');

return $routes;
