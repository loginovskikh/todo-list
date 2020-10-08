<?php
declare(strict_types=1);

namespace App\Domain\Task\Exceptions;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;

class TaskNotFoundException extends DomainException
{
    public $message = 'Task you requested does not exist.';
    public $code = StatusCodeInterface::STATUS_NOT_FOUND;
}