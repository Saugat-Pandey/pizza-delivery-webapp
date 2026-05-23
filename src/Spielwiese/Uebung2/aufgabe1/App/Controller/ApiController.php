<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/ApiModel.php';

class ApiController extends BaseController {
    /**
     * Retrieve all data necessary for the response.
     *
     * @return array Data array (assoziativ oder Apiiert)
     */
    private function getData(): array {
        $model = new ApiModel();
        return $model->getAll();
    }

    /**
     * Generate the full response output.
     * This method may output HTML, JSON, or other formats as needed.
     *
     * @return void
     */
    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderJson($data);
    }

    /**
     * Handles the full request lifecycle
     *
     * @return void
     */
    public function handleRequest(): void {
        $this->generateResponse();
    }
}


