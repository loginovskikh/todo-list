<?php
declare(strict_types=1);

namespace App\Domain\Task\Exceptions;

use App\Domain\DomainException\DomainException;

class TaskInvalidContentException extends DomainException
{
    public $message = 'Task validation failed. Content must be less than 1000 characters';
}