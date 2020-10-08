<?php
declare(strict_types=1);

namespace App\Application\Actions\Task;

use App\Application\Actions\Action;
use App\Domain\Task\Service\TaskServiceInterface;
use Psr\Log\LoggerInterface;


abstract class TaskAction extends Action
{
    /**
     * @var TaskServiceInterface
     */
    protected $taskService;

    public function __construct(LoggerInterface $logger, TaskServiceInterface $taskService)
    {
        parent::__construct($logger);
        $this->taskService = $taskService;
    }
}