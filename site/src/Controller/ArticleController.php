<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Service\ArticleService;

class ArticleController
{
    public function index(int $id)
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
}