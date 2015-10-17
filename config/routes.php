<?php
use Cake\Routing\Router;

Router::plugin('WnkTranslation', function ($routes) {
    $routes->fallbacks('DashedRoute');
});
