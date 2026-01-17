<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/CustomerModel.php';

class CustomerController extends BaseController{
     
    private CustomerModel $model;

    public function __construct()
    {
    $this->model = new CustomerModel();
    }

    public function processData():void {

    }


    private function getData():array {
        session_start();

        if (!isset($_SESSION['last_order_id'])) {
            return [
                'hasOrder' => false,
                'orderId' => null,
                'orders' => []
            ];
        }

        $orderId = (int)$_SESSION['last_order_id'];

        try {
            $orders = $this->model->getOrdersByOrderId($orderId);
        } catch (Exception $e) {
            $orders = [];
        }

        return [
            'hasOrder' => true,
            'orderId' => $orderId,
            'orders' => $orders
        ];
    }

    public function generateResponse(): void {
        $data = $this->getData();

        $this->renderHtml(
            'App/View/customer.view.php',
            
            [
                'data' => $data, 
                'isCustomerPage' => true
            ]
        );
    }



    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
}
}