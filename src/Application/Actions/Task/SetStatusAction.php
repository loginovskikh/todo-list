<?php


namespace App\Application\Actions\Task;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Note\Entity\Task;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

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