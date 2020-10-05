<?php


namespace App\Application\Actions\Note;


use App\Application\Actions\Action;

use App\Domain\Note\Service\NoteServiceInterface;
use Psr\Log\LoggerInterface;


abstract class NoteAction extends Action
{
    /**
     * @var NoteServiceInterface
     */
    protected $noteService;

    public function __construct(LoggerInterface $logger, NoteServiceInterface $noteService)
    {
        parent::__construct($logger);
        $this->noteService = $noteService;
    }
}