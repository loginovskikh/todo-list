<?php


namespace App\Application\Actions\Task;


use Psr\Http\Message\ResponseInterface as Response;

class SetStatusAction extends TaskAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $params = (array)$this->request->getParsedBody();
        $this->taskService->setStatus($this->resolveArg('id'), $params['status']);

        return $this->respondWithData();
    }
}