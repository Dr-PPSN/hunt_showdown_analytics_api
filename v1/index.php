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
    echo '<script src="script/script.js"></script>';
    echo '<br><center><h1>API-Dokumentation:</h1></center><br><br>';
    echo '<br><h2><u>GET:</u></h2>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/">https://api.rohrpasser.de/hunt_showdown_analytics/v1/</a> == Dokumentation</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather</a> == all weather data</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/sonnenaufgang">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/sonnenaufgang</a> == number of sunrises</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/sonnenuntergang">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/sonnenuntergang</a> == number of sunsets</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/regen">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/regen</a> == number of rainy days</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/wolkenlos">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/wolkenlos</a> == number of cloudless days</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/nebel">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/nebel</a> == number of foggy days</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/gold">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/gold</a> == number of golden days</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/mondnacht">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/mondnacht</a> == number of moon nights</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/nacht">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/nacht</a> == number of nights</h3>';
    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/event">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/event</a> == number of event weather</h3>';

    echo '<h3><a href="https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/count">https://api.rohrpasser.de/hunt_showdown_analytics/v1/getWeather/count</a> == count entries</h3>';

    echo '<hr><br><h2><u>PUT:</u></h2>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/sonnenaufgang == add 1 to number of sunrises   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/sonnenaufgang\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/sonnenuntergang == add 1 to number of sunsets   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/sonnenuntergang\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/regen == add 1 to number of rainy days   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/regen\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/wolkenlos == add 1 to number of cloudless days   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/wolkenlos\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/nebel == add 1 to number of foggy days   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/nebel\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/gold == add 1 to number of golden days   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/gold\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/mondnacht == add 1 to number of moon nights   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/mondnacht\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/nacht == add 1 to number of nights   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/nacht\')">PUT</button></h3>';
    echo '<h3>https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/event == add 1 to number of event weather   <button onclick="putRequest(\'https://api.rohrpasser.de/hunt_showdown_analytics/v1/putWeather/event\')">PUT</button></h3>';
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
