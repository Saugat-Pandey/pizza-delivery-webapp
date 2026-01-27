<?php 
require_once 'App/Core/BaseController.php';
require_once 'App/Model/DriverModel.php';

class DriverController extends BaseController {

    private DriverModel $model;
    
    public function __construct()
    {
        $this->model = new DriverModel();
    }


    public function processData(): void {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            return;
        }

        if (!isset($_POST["status"]) || !is_array($_POST['status'])){
            return;

        }

        foreach($_POST['status'] as $orderingId => $statusText){
            $orderingId =(int)$orderingId;

            switch($statusText){
                case 'fertig':
                    $statusCode = 2;
                    break;
                
                case 'unterwegs' :
                    $statusCode = 3;
                    break;

                case 'geliefert' :
                    $statusCode = 4;
                    break;
                default:
                    continue 2;

            }

            if($statusCode==4){
                $this->model->deleteOrder($orderingId);
            } else {
                $this->model-> updateOrderStatus($orderingId, $statusCode);
            }
        }

            header('Location: driver.php?message=updated');
            exit;


        }

        


    private function getData():array {
       
        $orders = $this->model->getOpenOrders();
        return 
        [
            'orders' =>$orders
        ];

    }



    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderHtml('App/View/driver.view.php', ['data' => $data]);
    }



    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}