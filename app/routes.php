<?php
declare(strict_types=1);

use App\Application\Actions\Note\GetAllCompletedAction;
use App\Application\Actions\Note\GetAllNotesAction;
use App\Application\Actions\Note\GetNoteByIdAction;
use App\Application\Actions\Note\SaveNoteAction;
use App\Application\Actions\Note\SetStatusNoteAction;
use App\Application\Actions\Note\UpdateNoteAction;
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
        $group->get('', GetAllNotesAction::class);
        $group->get('/{id:[0-9]+}', GetNoteByIdAction::class);
        $group->get('/completed', GetAllCompletedAction::class);
        $group->post('', SaveNoteAction::class);
        $group->post('/{id:[0-9]+}', SetStatusNoteAction::class);
        $group->put('/{id:[0-9]+}', UpdateNoteAction::class);
    });
};
