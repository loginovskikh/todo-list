<?php


namespace App\Infrastructure\Persistence\Service\Task;


use App\Domain\Task\Entity\Task;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Domain\Task\Service\TaskServiceInterface;
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
    public function update(Task $note): void
    {
        $this->taskRepository->update($note);
    }

    /**
     * @inheritDoc
     */
    public function save(Task $note): int
    {
        return $this->taskRepository->save($note);
    }
}