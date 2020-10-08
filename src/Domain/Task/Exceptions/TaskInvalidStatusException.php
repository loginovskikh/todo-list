<?php
declare(strict_types=1);

namespace App\Domain\Task\Exceptions;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;

class TaskInvalidStatusException extends DomainException
{
    public $message = 'Task validation failed. Unavailable status';
    public $code = StatusCodeInterface::STATUS_BAD_REQUEST;
}