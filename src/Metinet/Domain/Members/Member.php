<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain\Members;

use Metinet\Core\Security\Account;
use Metinet\Core\Security\EncodedPassword;
use Metinet\Domain\Conferences\Email;

class Member implements Account
{
    private $id;
    private $profile;
    private $email;
    private $encodedPassword;

    private function __construct($id, Profile $profile, Email $email, EncodedPassword $encodedPassword)
    {
        $this->id = $id;
        $this->profile = $profile;
        $this->email = $email;
        $this->encodedPassword = $encodedPassword;
    }

    public static function register(Profile $profile, Email $email, EncodedPassword $encodedPassword): self
    {
        return new self(uniqid(), $profile, $email, $encodedPassword);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            new Profile(
                $data['first_name'],
                $data['last_name'],
                'todo'
            ),
            new Email($data['email']),
            new EncodedPassword($data['encoded_password'], $data['password_salt'])
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function getEncodedPassword(): EncodedPassword
    {
        return $this->encodedPassword;
    }
}
