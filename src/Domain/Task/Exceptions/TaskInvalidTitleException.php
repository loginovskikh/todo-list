<?php
declare(strict_types=1);

namespace App\Domain\Task\Exceptions;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;

class TaskInvalidTitleException extends DomainException
{
    public $message = 'Task validation failed. Title must be not empty and less than 100 characters';
    public $code = StatusCodeInterface::STATUS_BAD_REQUEST;
}