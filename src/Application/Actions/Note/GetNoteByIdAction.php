<?php


namespace App\Application\Actions\Note;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class GetNoteByIdAction extends NoteAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id = $this->args['id'];
        $notes = $this->noteService->findNoteById($id);

        return $this->respondWithData($notes->jsonSerialize());
    }
}