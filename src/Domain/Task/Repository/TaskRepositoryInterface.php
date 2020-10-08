<?php
declare(strict_types=1);

namespace App\Domain\Task\Repository;

use App\Domain\Task\Entity\Task;
use App\Domain\Task\Exceptions\TaskNotFoundException;
use App\Domain\TaskCollection\Entity\TaskCollection;

interface TaskRepositoryInterface
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
     * @param Task $note
     */
    public function update(Task $note): void;

    /**
     * @param Task $task
     * @return int
     */
    public function save(Task $task): int;
}
