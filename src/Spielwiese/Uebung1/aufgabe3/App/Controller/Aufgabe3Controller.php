<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/Aufgabe3Model.php';

class IndexController extends BaseController {
    /**
     * Process incoming HTTP request data (GET, POST, etc.).
     *
     * @return void
     */
    public function processData(): void {
         /**
        * Example usage 
        * $model = new IndexModel();
        * $data = $model->create();
        * $data = $model->update();
        */
    }

    /**
     * Retrieve all data necessary for the response.
     *
     * @return array Data array (associative or indexed) to be used in generateResponse
     */
    private function getData(): array {
        /**
        * Example usage
        * $model = new IndexModel();
        * $data = $model->getAll();
        * $data = $model->getById();
        */
        return [];
    }

    /**
     * Generate the full response output.
     * This method may output HTML, JSON, or other formats as needed.
     *
     * @return void
     */
    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderHtml('App/View/aufgabe3.view.php', []);
    }

    /**
     * Handles the full request lifecycle
     *
     * @return void
     */
    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}
