<?php

use Artem\Blogapi\Controller\NotFoundController;
use Artem\Blogapi\Controller\ForbiddenController;
use Artem\Blogapi\Controller\ArticleController;
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;

SimpleRouter::get('/not-found', [NotFoundController::class, 'index']);
SimpleRouter::get('/forbidden', [ForbiddenController::class, 'index']);

SimpleRouter::error(function(Request $request, \Exception $exception) {
    switch($exception->getCode()) {
        // Page not found
        case 404:
            response()->redirect('/not-found');
        // Forbidden
        case 403:
            response()->redirect('/forbidden');
    }
    
});

// Article
SimpleRouter::get('/article/{id}', [ArticleController::class, 'index'])->where([ 'id' => '[0-9]+' ]);

// Comment