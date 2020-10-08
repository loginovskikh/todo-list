<?php
declare(strict_types=1);

use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Domain\Task\Service\TaskServiceInterface;
use App\Infrastructure\Persistence\Repository\Task\TaskPostgresRepository;
use App\Infrastructure\Persistence\Service\Task\TaskService;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([
        TaskRepositoryInterface::class => autowire(TaskPostgresRepository::class),
        TaskServiceInterface::class => autowire(TaskService::class)
    ]);
};
