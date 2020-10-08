<?php
declare(strict_types=1);

namespace App\Domain\Task\Service;


use App\Domain\Task\Entity\Task;
use App\Domain\Task\Entity\TaskDTO;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Domain\TaskCollection\Entity\TaskCollection;

class TaskService implements TaskServiceInterface
{

    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    /**
     * @inheritDoc
     */
    public function getAll(): TaskCollection
    {
        return $this->taskRepository->getAll();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Task
    {
        return $this->taskRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function getAllCompleted(): TaskCollection
    {
        return $this->taskRepository->getAllCompleted();
    }

    /**
     * @inheritDoc
     */
    public function setStatus(int $id, string $newStatus): void
    {
        $task = $this->taskRepository->findById($id);
        $task->setStatus($newStatus);
        $this->taskRepository->update($task);
    }

    /**
     * @inheritDoc
     */
    public function update(TaskDTO $taskDto): void
    {
        $task = Task::createFromDTO($taskDto);
        $this->taskRepository->update($task);
    }

    /**
     * @inheritDoc
     */
    public function save(TaskDTO $taskDto): int
    {
        $task = Task::createFromDTO($taskDto);
        return $this->taskRepository->save($task);
    }
}