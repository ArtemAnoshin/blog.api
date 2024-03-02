<?php

namespace Artem\Blogapi\Entity;

class Article
{
    private ?int $id;
    private string $authorName;
    private string $body;

    public function getId(): int|null { return $this->id; }
    public function getAuthorName(): string { return $this->authorName; }
    public function getBody(): string { return $this->body; }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function setAuthorName(string $authorName): static
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

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
}
