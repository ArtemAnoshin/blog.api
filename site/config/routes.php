<?php

use Artem\Blogapi\Controller\NotFoundController;
use Artem\Blogapi\Controller\ForbiddenController;
use Artem\Blogapi\Controller\ArticleController;
use Artem\Blogapi\Controller\CommentController;
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;

SimpleRouter::get('/not-found', [NotFoundController::class, 'index']);
SimpleRouter::get('/forbidden', [ForbiddenController::class, 'index']);

SimpleRouter::error(function(Request $request, \Exception $exception) {
    switch($exception->getCode()) {
        // Invalid Arguments
        case 422:
            response()->json([
                'success' => 'false',
                'message'  => $exception->getMessage(),
            ]);
        // Page not found
        case 404:
            response()->redirect('/not-found');
        // Forbidden
        case 403:
            response()->redirect('/forbidden');
    }
    
});

// Article
SimpleRouter::get('/articles', [ArticleController::class, 'list']);
SimpleRouter::get('/article/{id}', [ArticleController::class, 'read'])->where([ 'id' => '[0-9]+' ]);
SimpleRouter::get('/article/{id}/comments', [ArticleController::class, 'comments'])->where([ 'id' => '[0-9]+' ]);
SimpleRouter::post('/article', [ArticleController::class, 'create']);

// Comment
SimpleRouter::post('/comment', [CommentController::class, 'create']);