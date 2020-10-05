<?php


namespace App\Domain\NoteCollection\Entity;


use App\Domain\Note\Entity\Note;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class NoteCollection implements JsonSerializable, Countable, IteratorAggregate
{
    /**
     * @var Note[]
     */
    private $notes = [];

    /**
     * @param Note $note
     */
    public function addNote(Note $note): void
    {
        $this->notes[] = $note;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $notesArray = [];
        foreach ($this->notes as $note) {
            $notesArray[] = $note->jsonSerialize();
        }
        return $notesArray;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->notes);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->notes);
    }
}