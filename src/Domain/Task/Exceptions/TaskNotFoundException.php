<?php
declare(strict_types=1);

namespace App\Domain\Task\Exceptions;

use App\Domain\DomainException\DomainException;

class TaskNotFoundException extends DomainException
{
    public $message = 'Task you requested does not exist.';
}