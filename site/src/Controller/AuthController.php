<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Service\AuthService;
use Artem\Blogapi\Validator\UserLoginValidator;
use DateTimeImmutable;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AuthController
{
    public function login()
    {
        $validator = new UserLoginValidator();
        $validator->validate(input());

        $authService = new AuthService();
        if ($authService->isUserExists(input())) {
            $key = InMemory::base64Encoded(
                'hiG8DlOKvtih6AxlZn5XKImZ06yu8I3mkOzaJrEuW8yAv8Jnkw330uMt8AEqQ5LB'
            );

            $token = (new JwtFacade())->issue(
                new Sha256(),
                $key,
                static fn (
                    Builder $builder,
                    DateTimeImmutable $issuedAt
                ): Builder => $builder
                    ->issuedBy('http://blog.api')
                    ->permittedFor(input()->post('name')->value)
                    ->expiresAt($issuedAt->modify('+30 minutes'))
            );

            response()->json([
                'success' => 'ok',
                'token'  => $token->toString(),
            ]);
        } else {
            response()->httpCode(403);
            response()->json([
                'success' => 'false',
                'message'  => 'User not found.',
            ]);
        }
    }
}
