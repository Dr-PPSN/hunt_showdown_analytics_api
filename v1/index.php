<?php
require_once 'userInfo.php';
require_once 'sql.php';
require_once 'vendor/autoload.php';

//Routes:
//GET
//...v1/getWeather == all weather data
//...v1/getWeather?sonnenaufgang == number of sunrises
//...v1/getWeather?sonnenuntergang == number of sunsets
//...v1/getWeather?regen == number of rainy days
//......usw.
//...v1/getWeather?count == number of all weather data
//-----------------------------------------------------------
//PUT
//...v1/putWeather?sonnenaufgang == add 1 to number of sunrises
//...v1/putWeather?sonnenuntergang == add 1 to number of sunsets
//...v1/putWeather?regen == add 1 to number of rainy days
//......usw.

$router = new \Bramus\Router\Router();

$router->get('/', function() {
    echo 'Hello World!';
});

$router->get('/getWeather', function() {
    $sql = "SELECT * FROM wetter_log";
    $result = executeSQL($sql);
    echo json_encode($result);
});

$router->get('/getWeather/(\w+)', function($type) {
    $sql = "SELECT $type FROM wetter_log";
    $result = executeSQL($sql);
    echo json_encode($result);
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404 - Page not found!';
});

$router->run();
?>