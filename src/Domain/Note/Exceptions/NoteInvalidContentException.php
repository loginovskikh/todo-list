<?php
declare(strict_types=1);

namespace App\Domain\Note\Exceptions;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;

class NoteInvalidContentException extends DomainException
{
    public $message = 'Note validation failed. Content must be less than 1000 characters';
    public $code = StatusCodeInterface::STATUS_BAD_REQUEST;
}