<?php
require_once 'App/Core/DebugHelper.php';
require_once 'App/Controller/StatusApiController.php';

try {
    $controller = new StatusApiController();
    $controller->handleRequest();
} catch (Exception $e) {
    header("Content-Type: application/json");
    echo json_encode(['error' => $e->getMessage()]);
}