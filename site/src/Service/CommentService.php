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
        $comment->setCommentAuthor($request->post('comment_author')->value)
            ->setBody($request->post('body')->value)
            ->setArticleId($request->post('article_id')->value)
            ->setCreatedAt();

        return (new CommentManager())->create($comment);
    }
}