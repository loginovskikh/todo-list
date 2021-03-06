<?php
declare(strict_types=1);

namespace App\Application\Actions\Task;


use Psr\Http\Message\ResponseInterface as Response;

class GetByIdAction extends TaskAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id = $this->resolveArg('id');
        $notes = $this->taskService->findById($id);

        return $this->respondWithData($notes->jsonSerialize());
    }
}