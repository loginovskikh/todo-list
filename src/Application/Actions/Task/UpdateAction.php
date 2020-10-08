<?php


namespace App\Application\Actions\Task;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Task\Entity\Task;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateAction extends TaskAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $taskArray = (array)$this->request->getParsedBody();
        $taskArray['id'] = $this->args['id'];
        $task = Task::create($taskArray);
        $this->taskService->update($task);

        return $this->respondWithData();
    }
}