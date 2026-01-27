<?php
require_once 'App/Core/BaseController.php';
require_once 'App/Model/StatusApiModel.php';

class StatusApiController extends BaseController {

    private StatusApiModel $model;

    public function __construct() {
        $this->model = new StatusApiModel();
    }

    public function processData(): void {

    }

    private function getData(): array {
        session_start();

        if (!isset($_SESSION['last_order_id'])) {
            return [
                'hasOrder' => false,
                'orders' => []
            ];
        }

        $orderId = (int)$_SESSION['last_order_id'];

        $statuses = $this->model->getStatusByOrderId($orderId);

        return [
            'hasOrder' => true,
            'orderId' => $orderId,
            'orders' => $statuses
        ];
    }

    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderJson($data);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}
