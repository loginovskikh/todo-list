<?php


namespace App\Domain\Note\Service;


use App\Domain\Note\Entity\Note;
use App\Domain\Note\Exceptions\NoteNotFoundException;
use App\Domain\NoteCollection\Entity\NoteCollection;

interface NoteServiceInterface
{

    /**
     * @return NoteCollection
     */
    public function getAll(): NoteCollection;

    /**
     * @param int $id
     * @return Note
     * @throws NoteNotFoundException
     */
    public function findNoteById(int $id): Note;

    /**
     * @return NoteCollection
     */
    public function getAllCompleted(): NoteCollection;


    /**
     * @param int $id
     * @param string $newStatus
     * @return void
     */
    public function setStatus(int $id, string $newStatus): void;


    /**
     * @param Note $note
     */
    public function update(Note $note): void;

    /**
     * @param Note $note
     * @return int
     */
    public function save(Note $note): int;

}