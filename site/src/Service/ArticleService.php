<?php

namespace Artem\Blogapi\Service;

use Artem\Blogapi\Repository\ArticleRepository;
use Artem\Blogapi\Entity\Article;
use Artem\Blogapi\Manager\ArticleManager;
use Artem\Blogapi\Model\ArticlesWithCommentsCollection;
use Pecee\Http\Input\InputHandler;

class ArticleService
{
    const MAX_COUNT_IN_LIST = 15;

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

    public function getArticles(InputHandler $request): array|bool
    {
        $maxCount = $request->value('count') ?? self::MAX_COUNT_IN_LIST;
        $page = $request->value('page') ?? 1;

        $result = ArticleRepository::getArticles($maxCount, $page);

        if (empty($result)) {
            return false;
        }

        return $this->buildArticleList($result);
    }

    public function getCommentsByArticleId(int $id): array
    {
        return ArticleRepository::getCommentsByArticleId($id);
    }

    private function buildArticleList(array $collection): array
    {
        $articleCommentsCollection = new ArticlesWithCommentsCollection();

        foreach ($collection as $element)
        {
            $articleCommentsCollection->addToCollection($element);
        }

        return array_values($articleCommentsCollection->collection);
    }
}