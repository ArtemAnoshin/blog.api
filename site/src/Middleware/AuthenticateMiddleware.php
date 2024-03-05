<?php

namespace Artem\Blogapi\Middleware;

use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Validator;
use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\Clock\SystemClock;

class AuthenticateMiddleware implements IMiddleware
{
    public function handle(Request $request): void
    {
        $headers = getallheaders();
        $tokenString = substr($headers['Authorization'] ?? '', 7);
        $parser = new Parser(new JoseEncoder());

        try {
            $token = $parser->parse($tokenString);
        } catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
            throw new InvalidTokenStructure('Token is not valid.', 403);
        }

        assert($token instanceof UnencryptedToken);

        $validator = new Validator();

        if (! $validator->validate(
            $token,
            new StrictValidAt(SystemClock::fromUTC()),
        )) {
            throw new InvalidTokenStructure('Token is not valid.', 403);
        }
    }
}
