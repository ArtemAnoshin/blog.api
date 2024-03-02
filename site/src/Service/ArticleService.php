<?php

namespace Artem\Blogapi\Service;

use Artem\Blogapi\Repository\ArticleRepository;
use Artem\Blogapi\Entity\Article;

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
}