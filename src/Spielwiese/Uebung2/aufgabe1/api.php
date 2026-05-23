<?php
declare(strict_types=1);

require_once 'App/Core/DebugHelper.php';
require_once 'App/Controller/ApiController.php';

try {
    $controller = new ApiController();
    $controller->handleRequest();
} catch (Exception $e) {
    header("Content-type: text/html; charset=UTF-8");
    echo "<h1>Unexpected error occurred</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}