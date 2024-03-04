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
            response()->httpCode(201);
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

    public function list()
    {
        $service = new ArticleService();
        $articles = $service->getArticles(input());

        if ($articles) {
            response()->json([
                'success' => 'ok',
                'data'  => $articles,
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'No articles found.',
        ]);
    }

    public function comments(int $id)
    {
        $service = new ArticleService();
        $comments = $service->getCommentsByArticleId($id);

        if ($comments) {
            response()->json([
                'success' => 'ok',
                'data'  => $comments,
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'The article has no comments.',
        ]);
    }
}