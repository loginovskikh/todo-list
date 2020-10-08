<?php


namespace App\Application\Actions\Task;


use Psr\Http\Message\ResponseInterface as Response;

class GetAllCompletedAction extends TaskAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $tasks = $this->taskService->getAllCompleted();

        return $this->respondWithData($tasks->jsonSerialize());
    }
}