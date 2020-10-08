<?php


namespace App\Application\Actions\Task;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class GetByIdAction extends TaskAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id = $this->args['id'];
        $notes = $this->taskService->findById($id);

        return $this->respondWithData($notes->jsonSerialize());
    }
}