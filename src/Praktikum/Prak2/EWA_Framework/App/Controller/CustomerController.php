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

        $orders=$this->model->getAllOrdersWithStatus();
        return [
            'orders' => $orders 
        ];
    }

      public function generateResponse(): void {
        $data = $this->getData();
        $this->renderHtml('App/View/customer.view.php', ['data' => $data]);
    }



    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
}
}