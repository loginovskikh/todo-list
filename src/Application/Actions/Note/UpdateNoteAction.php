<?php


namespace App\Application\Actions\Note;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Note\Entity\Note;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateNoteAction extends NoteAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $noteArray = (array)$this->request->getParsedBody();
        $noteArray['id'] = $this->args['id'];
        $note = Note::create($noteArray);
        $this->noteService->update($note);

        return $this->respondWithData();
    }
}