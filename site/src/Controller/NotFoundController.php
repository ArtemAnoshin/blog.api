<?php

namespace Artem\Blogapi\Controller;

final class NotFoundController
{
    public function index()
    {
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=UTF-8');

            return 'The route was not found.';
        }
    }
}