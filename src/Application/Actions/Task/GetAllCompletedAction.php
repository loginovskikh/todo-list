<?php


namespace App\Application\Actions\Task;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

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