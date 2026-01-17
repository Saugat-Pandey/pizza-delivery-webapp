<?php
require_once 'App/Core/DebugHelper.php';
require_once 'App/Controller/DriverController.php';

try {
    $controller = new DriverController();
    $controller->handleRequest();
} catch (Exception $e) {
    header("Content-type: text/html; charset=UTF-8");
    echo "<h1>Unexpected error occurred</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}