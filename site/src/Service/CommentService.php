<?php

namespace Artem\Blogapi\Service;

use Artem\Blogapi\Repository\ArticleRepository;
use Artem\Blogapi\Entity\Article;
use Artem\Blogapi\Entity\Comment;
use Artem\Blogapi\Manager\CommentManager;
use Pecee\Http\Input\InputHandler;

class CommentService
{
    /*
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
    */

    public function createComment(InputHandler $request): int
    {
        $comment = new Comment();
        $comment->setCommentAuthor($request->value('comment_author'))
            ->setBody($request->value('body'))
            ->setArticleId($request->value('article_id'));

        return (new CommentManager())->create($comment);
    }
}