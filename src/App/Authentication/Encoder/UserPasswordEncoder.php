<?php
namespace App\Authentication\Encoder;

class UserPasswordEncoder implements UserPasswordEncoderInterface
{
    public function encodePassword(string $rawPassword, ?string $salt = null): string
    {
        return password_hash($rawPassword,  PASSWORD_BCRYPT);
    }
}
