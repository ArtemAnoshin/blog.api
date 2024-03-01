<?php

namespace Artem\Blogapi\Controller;

final class ForbiddenController
{
    public function index()
    {
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=UTF-8');

            return 'Access is denied.';
        }
    }
}