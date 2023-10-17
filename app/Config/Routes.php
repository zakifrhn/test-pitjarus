<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('data', 'Pages::fetchData');
$routes->post('Pages/fetchData', 'Pages::fetchData');
