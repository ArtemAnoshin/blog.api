<?php

namespace Artem\Blogapi\Entity;

class Comment
{
    private ?int $id;
    private string $commentAuthor;
    private string $body;
    private int $articleId;

    public function getId(): int|null { return $this->id; }
    public function getCommentAuthor(): string { return $this->commentAuthor; }
    public function getBody(): string { return $this->body; }
    public function getArticleId(): int { return $this->articleId; }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function setCommentAuthor(string $authorName): static
    {
        $this->commentAuthor = $authorName;

        return $this;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function setArticleId(int $articleId) : static
    {
        $this->articleId = $articleId;

        return $this;
    }

    /*
    public function asArray()
    {
        $result = [];

        if ($this->getId()) {
            $result['id'] = $this->getId();
        }

        if ($this->getAuthorName()) {
            $result['author_name'] = $this->getAuthorName();
        }

        if ($this->getBody()) {
            $result['body'] = $this->getBody();
        }

        return $result;
    }
    */
}
