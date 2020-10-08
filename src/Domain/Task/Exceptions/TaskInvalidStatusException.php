<?php
declare(strict_types=1);

namespace App\Domain\Task\Exceptions;

use App\Domain\DomainException\DomainException;

class TaskInvalidStatusException extends DomainException
{
    public $message = 'Task validation failed. Unavailable status';
}