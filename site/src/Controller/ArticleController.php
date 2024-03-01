<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Repository\ArticleRepository;

class ArticleController
{
    public function index(int $id)
    {
        $article = ArticleRepository::getById($id);

        print_r($article);
        echo $id;
    }
}