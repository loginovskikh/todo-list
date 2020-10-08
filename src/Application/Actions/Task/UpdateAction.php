<?php


namespace App\Application\Actions\Task;


use App\Domain\Task\Entity\Task;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateAction extends TaskAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $taskArray = (array)$this->request->getParsedBody();
        $taskArray['id'] = $this->resolveArg('id');
        $task = Task::create($taskArray);
        $this->taskService->update($task);

        return $this->respondWithData();
    }
}