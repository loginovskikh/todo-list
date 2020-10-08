<?php


namespace App\Infrastructure\Persistence\Repository\Task;


use App\Domain\Task\Entity\Task;
use App\Domain\Task\Exceptions\TaskNotFoundException;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Domain\TaskCollection\Entity\TaskCollection;
use PDO;

class TaskPostgresRepository implements TaskRepositoryInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): TaskCollection
    {
        $taskCollection = new TaskCollection();
        $sql = 'SELECT * FROM tasks WHERE status = :status';
        $query = $this->pdo->prepare($sql);
        $query->execute(['status' => 'active']);
        if($query){
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $task = Task::createFromArray($row);
                $taskCollection->addTask($task);
            }
        }
        else {
            throw new TaskNotFoundException();
        }

        return $taskCollection;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Task
    {
        $sql = 'SELECT * FROM tasks WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        $row = $query->fetchAll();
        if(!$row) {
            throw new TaskNotFoundException();
        }
        return Task::createFromArray($row[0]);
    }

    /**
     * @inheritDoc
     */
    public function getAllCompleted(): TaskCollection
    {
        $taskCollection = new TaskCollection();
        $sql = "SELECT * FROM tasks WHERE status = 'completed'";
        $query = $this->pdo->query($sql);
        while($row = $query->fetch()) {
            $task = Task::createFromArray($row);
            $taskCollection->addTask($task);
        }

        return $taskCollection;
    }

    /**
     * @inheritDoc
     */
    public function update(Task $task): void
    {
        $sql = 'UPDATE tasks SET title = :title, content = :content, status = :status WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $task->getTitle(),
            'content' => $task->getContent(),
            'status' => $task->getStatus(),
            'id' => $task->getId()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function save(Task $task): int
    {
        $sql = 'INSERT INTO tasks (title , content , status) VALUES (:title, :content, :status)';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $task->getTitle(),
            'content' => $task->getContent(),
            'status' => $task->getStatus(),
        ]);
        return $this->pdo->lastInsertId();
    }
}