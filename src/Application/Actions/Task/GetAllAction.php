<?php


namespace App\Application\Actions\Task;

use Psr\Http\Message\ResponseInterface as Response;

class GetAllAction extends TaskAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $tasks = $this->taskService->getAll();

        return $this->respondWithData($tasks->jsonSerialize());
    }
}