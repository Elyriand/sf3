<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Infrastructure\Repositories;

use Metinet\Core\Security\EncodedPassword;
use Metinet\Core\Security\PlainTextPasswordEncoder;
use Metinet\Domain\Conferences\Email;
use Metinet\Domain\Members\Member;
use Metinet\Domain\Members\MemberNotFound;
use Metinet\Domain\Members\MemberRepository;
use Metinet\Domain\Members\Profile;

class PdoMemberRepository implements MemberRepository
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Member $member): void
    {
        $query =<<<MYSQL
INSERT INTO members (id, first_name, last_name, email, encoded_password, password_salt) 
VALUES(:id, :firstName, :lastName, :email, :encodedPassword, :passwordSalt) ON DUPLICATE KEY UPDATE    
first_name=:firstName, last_name=:lastName, email=:email, encoded_password=:encodedPassword, password_salt=:passwordSalt
MYSQL;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id' => $member->getId(),
            'firstName' => $member->getProfile()->getFirstName(),
            'lastName' => $member->getProfile()->getLastName(),
            'email' => $member->getEmail(),
            'encodedPassword' => $member->getEncodedPassword()->getEncodedPassword(),
            'passwordSalt' => $member->getEncodedPassword()->getSalt(),
        ]);
    }

    public function findByEmail(Email $email): Member
    {
        $query =<<<MYSQL
SELECT * FROM members WHERE email = :email;
MYSQL;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (false !== $row) {

            return Member::fromArray($row);
        }

        throw new MemberNotFound($email);
    }
}
