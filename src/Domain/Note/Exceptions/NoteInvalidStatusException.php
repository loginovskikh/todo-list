<?php
declare(strict_types=1);

namespace App\Domain\Note\Exceptions;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;

class NoteInvalidStatusException extends DomainException
{
    public $message = 'Note validation failed. Unavailable status';
    public $code = StatusCodeInterface::STATUS_BAD_REQUEST;
}