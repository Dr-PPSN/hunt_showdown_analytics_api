<?php
require_once 'userInfo.php';
require_once 'db/sql.php';
require_once 'vendor/autoload.php';

//Routes:
//GET
//...v1/getWeather == all weather data
//...v1/getWeather/sonnenaufgang == number of sunrises
//...v1/getWeather/sonnenuntergang == number of sunsets
//...v1/getWeather/regen == number of rainy days
//......usw.
//...v1/getWeather/count == number of all weather data
//-----------------------------------------------------------
//PUT
//...v1/putWeather/sonnenaufgang == add 1 to number of sunrises
//...v1/putWeather/sonnenuntergang == add 1 to number of sunsets
//...v1/putWeather/regen == add 1 to number of rainy days
//......usw.

$router = new \Bramus\Router\Router();

$router->get('/', function() {
    echo 'Hello World!';
});

$router->get('/getWeather', function() {
    header('Content-Type: application/json');
    $sql = "SELECT * FROM weather_log";
    $result = executeSQL($sql);
    echo json_encode($result);
});

$router->get('/getWeather/(\w+)', function($weatherType) {
    header('Content-Type: application/json');
    $sql = "SELECT * FROM weather_log WHERE weather = '$weatherType'";
    $result = executeSQL($sql);
    if (empty($result)) {
        echo http_response_code(404);
    } else {
        echo json_encode($result);
    }
});

$router->get('/getWeather/count', function() {
    header('Content-Type: application/json');
    $sql = "SELECT COUNT(*) FROM weather_log";
    $result = executeSQL($sql);
    echo json_encode($result);
});

$router->put('/putWeather/(\w+)', function($weatherType) {
    header('Content-Type: application/json');
    $possibleWeatherTypes = array(
        'sonnenaufgang', 
        'sonnenuntergang', 
        'regen', 
        'wolkenlos', 
        'nebel', 
        'gold', 
        'mondnacht', 
        'nacht', 
        'event'
    );
    if (empty($weatherType)) {
        echo http_response_code(404);
    }
    else if (in_array($weatherType, $possibleWeatherTypes)) {
        $sql = 'UPDATE weather_log SET counter = counter + 1 WHERE weather = "'. $weatherType .'"';
        $result = executeSQL($sql);
        $sql = "SELECT * FROM weather_log WHERE weather = '$weatherType'";
        $result = executeSQL($sql);
        echo json_encode($result);
    } else {
        echo http_response_code(404);
    }
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404 - Page not found!';
});

$router->run();
?>
