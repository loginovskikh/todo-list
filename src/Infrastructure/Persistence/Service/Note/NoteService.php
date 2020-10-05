<?php


namespace App\Infrastructure\Persistence\Service\Note;


use App\Domain\Note\Entity\Note;
use App\Domain\Note\Repository\NoteRepositoryInterface;
use App\Domain\Note\Service\NoteServiceInterface;
use App\Domain\NoteCollection\Entity\NoteCollection;

class NoteService implements NoteServiceInterface
{

    /**
     * @var NoteRepositoryInterface
     */
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }
    /**
     * @inheritDoc
     */
    public function getAll(): NoteCollection
    {
        return $this->noteRepository->getAll();
    }

    /**
     * @inheritDoc
     */
    public function findNoteById(int $id): Note
    {
        return $this->noteRepository->findNoteById($id);
    }

    /**
     * @inheritDoc
     */
    public function getAllCompleted(): NoteCollection
    {
        return $this->noteRepository->getAllCompleted();
    }

    /**
     * @inheritDoc
     */
    public function setStatus(int $id, string $newStatus): void
    {
        $this->noteRepository->setStatus($id, $newStatus);
    }

    /**
     * @inheritDoc
     */
    public function update(Note $note): void
    {
        $this->noteRepository->update($note);
    }

    /**
     * @inheritDoc
     */
    public function save(Note $note): int
    {
        return $this->noteRepository->save($note);
    }
}