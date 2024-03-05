<?php

namespace Artem\Blogapi\Service;

use Artem\Blogapi\Repository\UserRepository;
use Pecee\Http\Input\InputHandler;

class AuthService
{
    public function isUserExists(InputHandler $request): bool
    {
        $name = $request->post('name')->value;
        $password = md5($request->post('password')->value);

        if (UserRepository::isUserExists(name: $name, password: $password)) {
            return true;
        }

        return false;
    }
}