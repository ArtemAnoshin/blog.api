<?php

namespace Artem\Blogapi\Service;

use Artem\Blogapi\Entity\Comment;
use Artem\Blogapi\Manager\CommentManager;
use Pecee\Http\Input\InputHandler;

class CommentService
{
    public function createComment(InputHandler $request): int
    {
        $comment = new Comment();
        $comment->setCommentAuthor($request->value('comment_author'))
            ->setBody($request->value('body'))
            ->setArticleId($request->value('article_id'))
            ->setCreatedAt();

        return (new CommentManager())->create($comment);
    }
}