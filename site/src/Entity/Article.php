<?php

namespace Artem\Blogapi\Entity;

class Article
{
    private ?int $id;
    private string $authorName;
    private string $body;

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
}
