<?php
declare(strict_types=1);

namespace App\Domain\Note\Exceptions;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;

class NoteNotFoundException extends DomainException
{
    public $message = 'Note you requested does not exist.';
    public $code = StatusCodeInterface::STATUS_NOT_FOUND;
}