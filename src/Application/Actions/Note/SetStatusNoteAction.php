<?php


namespace App\Application\Actions\Note;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Note\Entity\Note;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class SetStatusNoteAction extends NoteAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $params = (array)$this->request->getParsedBody();
        $this->noteService->setStatus($this->args['id'], $params['status']);

        return $this->respondWithData();
    }
}