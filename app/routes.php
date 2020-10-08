<?php
declare(strict_types=1);

use App\Application\Actions\Task\GetAllCompletedAction;
use App\Application\Actions\Task\GetAllAction;
use App\Application\Actions\Task\GetByIdAction;
use App\Application\Actions\Task\SaveAction;
use App\Application\Actions\Task\SetStatusAction;
use App\Application\Actions\Task\UpdateAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->group('/notes', function (Group $group) {
        $group->get('', GetAllAction::class);
        $group->get('/{id:[0-9]+}', GetByIdAction::class);
        $group->get('/completed', GetAllCompletedAction::class);
        $group->post('', SaveAction::class);
        $group->post('/{id:[0-9]+}', SetStatusAction::class);
        $group->put('/{id:[0-9]+}', UpdateAction::class);
    });
};
