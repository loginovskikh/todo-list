<?php


namespace App\Application\Actions\Note;


use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Note\Entity\Note;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class SaveNoteAction extends NoteAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $noteArray = (array)$this->request->getParsedBody();
        $note = Note::create($noteArray);
        $noteId = $this->noteService->save($note);

        return $this->respondWithData(['id' => $noteId]);
    }
}