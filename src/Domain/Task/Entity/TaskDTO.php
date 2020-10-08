<?php
declare(strict_types=1);

namespace App\Domain\Task\Entity;


class TaskDTO
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $status;

    public function __construct(?int $id, string $title, string $content, string $status)
    {
        $this->id = $id;
        $this->content = $content;
        $this->title = $title;
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    public static function create(array $data): TaskDTO
    {
        $validData['id'] = $data['id'] ?? null;
        $validData['title'] = $data['title'] ?? '';
        $validData['content'] = $data['content'] ?? '';
        $validData['status'] = $data['status'] ?? '';

        return new TaskDTO($validData['id'], $validData['title'], $validData['content'], $validData['status']);
    }

}