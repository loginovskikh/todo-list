<?php

namespace App\Domain\Note\Entity;

use App\Domain\Note\Exceptions\NoteInvalidContentException;
use App\Domain\Note\Exceptions\NoteInvalidStatusException;
use App\Domain\Note\Exceptions\NoteInvalidTitleException;
use JsonSerializable;

class Note implements JsonSerializable
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

    private const CONTENT_MINIMAL_LENGTH = 1;

    private const CONTENT_MAX_LENGTH = 1000;

    private const TITLE_MINIMAL_LENGTH = 1;

    private const TITLE_MAX_LENGTH = 100;

    private const STATUSES = ['active', 'completed'];

    public function __construct(?int $id, string $title, string $content, string $status)
    {
        $this->id = $id;
        $this->setContent($content);
        $this->setTitle($title);
        $this->setStatus($status);
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

    /**
     * @param string $status
     * @throws NoteInvalidStatusException
     */
    public function setStatus(string $status): void
    {
        if(!in_array($status, self::STATUSES)){
            throw new NoteInvalidStatusException();
        }
        $this->status = $status;
    }

    /**
     * @param string $title
     * @throws NoteInvalidTitleException
     */
    public function setTitle(string $title): void
    {
        $titleLength = mb_strlen($title);
        if($titleLength < self::TITLE_MINIMAL_LENGTH || $titleLength > self::TITLE_MAX_LENGTH) {
            throw new NoteInvalidTitleException();
        }
        $this->title = $title;
    }

    /**
     * @param string $content
     * @throws NoteInvalidContentException
     */
    public function setContent(string $content): void
    {
        $contentLength = mb_strlen($content);
        if($contentLength < self::CONTENT_MINIMAL_LENGTH || $contentLength > self::CONTENT_MAX_LENGTH) {
            throw new NoteInvalidContentException();
        }
        $this->content = $content;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'status' => $this->getStatus()
        ];
    }

    public static function create(array $data): Note
    {
        $data = self::validateCreateArray($data);
        return new Note($data['id'], $data['title'], $data['content'], $data['status']);
    }

    private static function validateCreateArray(array $data)
    {
        $validData['id'] = $data['id'] ?? null;
        $validData['title'] = $data['title'] ?? '';
        $validData['content'] = $data['content'] ?? '';
        $validData['status'] = $data['status'] ?? '';

        return $validData;
    }
}