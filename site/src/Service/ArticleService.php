<?php

namespace Artem\Blogapi\Service;

use Artem\Blogapi\Repository\ArticleRepository;
use Artem\Blogapi\Entity\Article;
use Artem\Blogapi\Manager\ArticleManager;
use Pecee\Http\Input\InputHandler;

class ArticleService
{
    public function getArticleById(int $id): Article|bool
    {
        $result = ArticleRepository::getById($id);

        if (is_array($result) && !empty($result)) {
            $article = new Article();
            $article->setId($id)
                ->setAuthorName($result['author_name'])
                ->setBody($result['body']);

            return $article;
        }

        return false;
    }

    public function createArticle(InputHandler $request): int
    {
        $article = new Article();
        $article->setAuthorName($request->value('author_name'))
            ->setBody($request->value('body'));

        return (new ArticleManager())->create($article);
    }
}