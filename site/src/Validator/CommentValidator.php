<?php

namespace Artem\Blogapi\Validator;

use InvalidArgumentException;
use Pecee\Http\Input\InputHandler;

class CommentValidator
{
    public function validate(InputHandler $request)
    {
        if (!$request->exists('comment_author')) {
            throw new InvalidArgumentException('Author name is required', 422);
        }

        if (strlen($request->value('comment_author')) > 255) {
            throw new InvalidArgumentException('The author\'s name cannot be more than 255 characters', 422);
        }

        if (!$request->exists('body')) {
            throw new InvalidArgumentException('Body is required', 422);
        }

        if (strlen($request->value('body')) > 200) {
            throw new InvalidArgumentException('The body cannot be more than 200 characters', 422);
        }

        if (!$request->exists('article_id')) {
            throw new InvalidArgumentException('Article ID is required', 422);
        }
    }
}