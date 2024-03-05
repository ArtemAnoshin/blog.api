<?php

namespace Artem\Blogapi\Validator;

use InvalidArgumentException;
use Pecee\Http\Input\InputHandler;

class UserLoginValidator
{
    public function validate(InputHandler $request)
    {
        if (!$request->exists('name')) {
            throw new InvalidArgumentException('Name is required', 422);
        }

        if (!$request->exists('password')) {
            throw new InvalidArgumentException('Password is required', 422);
        }
    }
}