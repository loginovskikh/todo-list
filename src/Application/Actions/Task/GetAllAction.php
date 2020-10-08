<?php
declare(strict_types=1);

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