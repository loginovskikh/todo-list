<?php


namespace App\Domain\Task\Service;


use App\Domain\Task\Entity\Task;
use App\Domain\Task\Exceptions\TaskNotFoundException;
use App\Domain\TaskCollection\Entity\TaskCollection;

interface TaskServiceInterface
{

    /**
     * @return TaskCollection
     */
    public function getAll(): TaskCollection;

    /**
     * @param int $id
     * @return Task
     * @throws TaskNotFoundException
     */
    public function findById(int $id): Task;

    /**
     * @return TaskCollection
     */
    public function getAllCompleted(): TaskCollection;


    /**
     * @param int $id
     * @param string $newStatus
     * @return void
     */
    public function setStatus(int $id, string $newStatus): void;


    /**
     * @param Task $note
     */
    public function update(Task $note): void;

    /**
     * @param Task $note
     * @return int
     */
    public function save(Task $note): int;

}