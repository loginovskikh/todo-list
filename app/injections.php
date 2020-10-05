<?php
declare(strict_types=1);

use App\Domain\Note\Repository\NoteRepositoryInterface;
use App\Domain\Note\Service\NoteServiceInterface;
use App\Infrastructure\Persistence\Repository\Note\NotePostgresRepository;
use App\Infrastructure\Persistence\Service\Note\NoteService;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([
        NoteRepositoryInterface::class => autowire(NotePostgresRepository::class),
        NoteServiceInterface::class => autowire(NoteService::class)
    ]);
};
