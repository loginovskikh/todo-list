<?php


namespace App\Infrastructure\Persistence\Repository\Note;


use App\Domain\Note\Entity\Note;
use App\Domain\Note\Exceptions\NoteNotFoundException;
use App\Domain\Note\Repository\NoteRepositoryInterface;
use App\Domain\NoteCollection\Entity\NoteCollection;
use PDO;

class NotePostgresRepository implements NoteRepositoryInterface
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
    public function getAll(): NoteCollection
    {
        $noteCollection = new NoteCollection();
        $sql = 'SELECT * FROM notes WHERE status = :status';
        $query = $this->pdo->prepare($sql);
        $query->execute(['status' => 'active']);
        if($query){
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $note = Note::create($row);
                $noteCollection->addNote($note);
            }
        }
        else {
            throw new NoteNotFoundException();
        }

        return $noteCollection;
    }

    /**
     * @inheritDoc
     */
    public function findNoteById(int $id): Note
    {
        $sql = 'SELECT * FROM notes WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        $row = $query->fetchAll();
        if(!$row) {
            throw new NoteNotFoundException();
        }
        return Note::create($row[0]);
    }

    /**
     * @inheritDoc
     */
    public function getAllCompleted(): NoteCollection
    {
        $noteCollection = new NoteCollection();
        $sql = "SELECT * FROM notes WHERE status = 'completed'";
        $query = $this->pdo->query($sql);
        while($row = $query->fetch()) {
            $note = Note::create($row);
            $noteCollection->addNote($note);
        }

        return $noteCollection;
    }

    /**
     * @inheritDoc
     */
    public function setStatus(int $id, string $newStatus): void
    {
        $sql = 'UPDATE notes SET status = :status WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'status' => $newStatus,
            'id' => $id
        ]);
    }

    /**
     * @inheritDoc
     */
    public function update(Note $note): void
    {
        $sql = 'UPDATE notes SET title = :title, content = :content, status = :status WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $note->getTitle(),
            'content' => $note->getContent(),
            'status' => $note->getStatus(),
            'id' => $note->getId()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function save(Note $note): int
    {
        $sql = 'INSERT INTO notes (title , content , status) VALUES (:title, :content, :status)';
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $note->getTitle(),
            'content' => $note->getContent(),
            'status' => $note->getStatus(),
        ]);
        return $this->pdo->lastInsertId();
    }
}