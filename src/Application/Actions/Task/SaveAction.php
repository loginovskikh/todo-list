<?php
declare(strict_types=1);

namespace App\Application\Actions\Task;

use App\Domain\Task\Entity\TaskDTO;
use Psr\Http\Message\ResponseInterface as Response;

class SaveAction extends TaskAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $taskArray = (array)$this->request->getParsedBody();
        $task = TaskDTO::create($taskArray);
        $taskId = $this->taskService->save($task);

        return $this->respondWithData(['id' => $taskId]);
    }
}