<?php

namespace Artem\Blogapi\Validator;

use InvalidArgumentException;
use Pecee\Http\Input\InputHandler;

class ArticleValidator
{
    public function validate(InputHandler $request)
    {
        if (!$request->exists('author_name')) {
            throw new InvalidArgumentException('Author name is required', 422);
        }

        if (strlen($request->value('author_name')) > 255) {
            throw new InvalidArgumentException('The author\'s name cannot be more than 255 characters', 422);
        }

        if (!$request->exists('body')) {
            throw new InvalidArgumentException('Body is required', 422);
        }

        if (strlen($request->value('body')) > 5000) {
            throw new InvalidArgumentException('The body cannot be more than 5000 characters', 422);
        }
    }
}