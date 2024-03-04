<?php

namespace Artem\Blogapi\Model;

class ArticlesWithCommentsCollection
{
    public array $collection = [];

    public function addToCollection(array $element)
    {
        if (!$this->inCollection($element['article_id'])) {
            $this->collection[$element['article_id']] = [
                'article_id' => $element['article_id'],
                'author_name' => $element['author_name'],
                'article_text' => $element['article_text'],
                'comments' => [
                    [
                        'comment_id' => $element['comment_id'],
                        'comment_author' => $element['comment_author'],
                        'comment_text' => $element['comment_text'],
                    ]
                ],
            ];
        } else {
            $this->collection[$element['article_id']]['comments'][] = [
                'comment_id' => $element['comment_id'],
                'comment_author' => $element['comment_author'],
                'comment_text' => $element['comment_text'],
            ];
        }
    }

    private function inCollection(int $articleId): bool
    {
        if (isset($this->collection[$articleId])) {
            return true;
        }

        return false;
    }
}