<?php
require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderModel.php';

class OrderController extends BaseController
{
    /**
     * Handle POST request:
     * - Read form inputs
     * - Create new Order
     * - Redirect (PRG pattern)
     */

    public function processData(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $address = trim($_POST['adresse'] ?? '');
            $pizzasIds = $_POST['pizzas'] ?? [];

            try {
                $model = new OrderModel();

                $orderId = $model->createOrder($address, $pizzasIds);

                header("Location: customer.php?bestellt=$orderId");
                exit;
            } catch (Exception $e) {
                echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
    }

    /**
     * Load data from DB for the order page:
     * - Menu from article table
     */
    private function getData(): array
    {
        $model = new OrderModel();

        try {
            $menu = $model->getMenu();
        } catch (Exception $e) {
            $menu = [];
            echo "<p style='color:red;'>Menu load error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

        return [
            'menu' => $menu
        ];
    }

    /**
     * Render the order view.
     */
    public function generateResponse(): void
    {
        $data = $this->getData();
        $this->renderHtml('App/View/order.view.php', ['data' => $data]);
    }

    /**
     * Application flow:
     * 1) process POST Data
     * 2) render HTML page
     */
    public function handleRequest(): void
    {
        $this->processData();
        $this->generateResponse();
    }
}

