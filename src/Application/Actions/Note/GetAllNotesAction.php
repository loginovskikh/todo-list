<?php


namespace App\Application\Actions\Note;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class GetAllNotesAction extends NoteAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $notes = $this->noteService->getAll();

        return $this->respondWithData($notes->jsonSerialize());
    }
}