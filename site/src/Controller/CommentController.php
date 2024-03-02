<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Service\CommentService;
use Artem\Blogapi\Validator\CommentValidator;

class CommentController
{
    /*
    public function read(int $id)
    {
        $service = new ArticleService();
        $article = $service->getArticleById($id);

        if ($article) {
            response()->json([
                'success' => 'ok',
                'data'  => $article->asArray(),
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'Article not found.',
        ]);
    }
    */

    public function create()
    {
        $validator = new CommentValidator();
        $validator->validate(input());


        $service = new CommentService();
        $id = $service->createComment(input());

        if ($id) {
            response()->httpCode(201);
            response()->json([
                'success' => 'ok',
                'comment_id'  => $id,
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'Something went wrong.',
        ]);
    }
}