<?php

namespace Artem\Blogapi\Manager;

use Artem\Blogapi\Db\Db;
use Artem\Blogapi\Entity\Comment;
use Exception;
use InvalidArgumentException;

class CommentManager
{
    public function create(Comment $comment): int
    {
        $db = Db::getInstance();

        $sql = "INSERT INTO comment (comment_author, body, article_id) VALUES (:comment_author, :body, :article_id);";
        $query = $db::prepare($sql);

        try {
            $query->execute([
                'comment_author' => $comment->getCommentAuthor(),
                'body' => $comment->getBody(),
                'article_id' => $comment->getArticleId(),
            ]);
    
            return $db::lastInsertId();
        } catch (Exception $ex) {
            throw new InvalidArgumentException('Article is not found', 422); 
        }
    }
}
