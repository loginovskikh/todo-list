<?php


namespace App\Application\Actions\Task;


use App\Domain\Task\Entity\Task;
use Psr\Http\Message\ResponseInterface as Response;

class SaveAction extends TaskAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $taskArray = (array)$this->request->getParsedBody();
        $task = Task::create($taskArray);
        $taskId = $this->taskService->save($task);

        return $this->respondWithData(['id' => $taskId]);
    }
}