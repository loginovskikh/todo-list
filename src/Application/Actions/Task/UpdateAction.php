<?php


namespace App\Application\Actions\Task;

use App\Domain\Task\Entity\TaskDTO;
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
        $task = TaskDTO::create($taskArray);
        $this->taskService->update($task);

        return $this->respondWithData();
    }
}