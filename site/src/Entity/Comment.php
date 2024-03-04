<?php

namespace Artem\Blogapi\Entity;

use DateTimeImmutable;

class Comment
{
    private ?int $id;
    private string $commentAuthor;
    private string $body;
    private int $articleId;
    private ?DateTimeImmutable $createdAt;

    public function getId(): int|null { return $this->id; }
    public function getCommentAuthor(): string { return $this->commentAuthor; }
    public function getBody(): string { return $this->body; }
    public function getArticleId(): int { return $this->articleId; }
    public function getCreatedAt(): string { return $this->createdAt->format('Y-m-d H:i'); }

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

    public function setCreatedAt(): static
    {
        $this->createdAt = new DateTimeImmutable();

        return $this;
    }
}
