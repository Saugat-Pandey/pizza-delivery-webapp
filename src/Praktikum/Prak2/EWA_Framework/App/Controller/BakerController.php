<?php

require_once 'App/Core/BaseController.php';
require_once 'App/Model/BakerModel.php';

class BakerController extends BaseController {
    /**
     * Handle POST: status changes from baker.
     */
    public function processData(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderedArticleId = (int)($_POST['oa_id'] ?? 0);
            $newStatus = (int)($_POST['status'] ?? -1);

            if ($orderedArticleId > 0 && $newStatus >= 0) {
                try {
                    $model = new BakerModel();
                    $model->updateStatus($orderedArticleId, $newStatus);

                    header('Location: baker.php?message=updated');
                    exit;
                } catch (Exception $e) {
                    echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
        }
    }

    /**
     * Load all pizzas relevant for the baker.
     */
    private function getData(): array {
        $model = new BakerModel();

        try {
            $pizzas = $model->getOpenPizzas();
        } catch (Exception $e) {
            $pizzas = [];
            echo "<p style='color:red;'>Error loading data: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

        return ['pizzas' => $pizzas];
    }

    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderHtml('App/View/baker.view.php', ['data' => $data]);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}