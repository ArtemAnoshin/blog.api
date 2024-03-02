<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Service\ArticleService;
use Artem\Blogapi\Validator\ArticleValidator;

class ArticleController
{
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

    public function create()
    {
        $validator = new ArticleValidator();
        $validator->validate(input());

        $service = new ArticleService();
        $id = $service->createArticle(input());

        if ($id) {
            response()->json([
                'success' => 'ok',
                'article_id'  => $id,
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'Something went wrong.',
        ]);
    }
}