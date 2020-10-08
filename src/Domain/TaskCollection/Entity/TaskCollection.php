<?php


namespace App\Domain\TaskCollection\Entity;


use App\Domain\Task\Entity\Task;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class TaskCollection implements JsonSerializable, Countable, IteratorAggregate
{
    /**
     * @var Task[]
     */
    private $notes = [];

    /**
     * @param Task $note
     */
    public function addTask(Task $note): void
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