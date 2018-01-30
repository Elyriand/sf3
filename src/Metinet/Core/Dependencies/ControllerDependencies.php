<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Dependencies;

use Metinet\Core\Config\Configuration;
use Metinet\Core\Logger\Logger;
use Metinet\Core\Security\AccountAuthenticator;
use Metinet\Core\Security\AccountProvider;
use Metinet\Core\Security\AuthenticationContext;
use Metinet\Core\Security\PasswordEncoder;
use Metinet\Core\Security\PlainTextPasswordEncoder;
use Metinet\Core\Security\Sha1PasswordEncoder;
use Metinet\Core\Session\NativeSession;
use Metinet\Core\Session\Session;
use Metinet\Core\Templating\PhpViewRenderer;
use Metinet\Core\Templating\ViewRenderer;
use Metinet\Domain\Conferences\ConferenceRepository;
use Metinet\Domain\Members\MemberRepository;
use Metinet\Infrastructure\Repositories\InMemoryConferenceRepository;
use Metinet\Infrastructure\Repositories\InMemoryMemberRepository;
use Metinet\Infrastructure\Repositories\PdoMemberRepository;
use Metinet\Infrastructure\Security\MemberAccountProvider;

class ControllerDependencies
{
    private $configuration;
    private $viewRenderer;
    private $authenticationContext;
    private $accountAuthenticator;
    private $session;
    private $memberRepository;
    private $conferenceRepository;
    private $accountProvider;
    private $passwordEncoder;
    private $pdo;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getLogger(): Logger
    {
        return $this->configuration->getLogger();
    }

    public function getDatabase(): \PDO
    {
        if (!$this->pdo) {
            
            $this->pdo = new \PDO(
                sprintf(
                    'mysql:dbname=%s;host=%s',
                    $this->configuration->getSection('database')['name'],
                    $this->configuration->getSection('database')['host']
                ),
                $this->configuration->getSection('database')['user'],
                $this->configuration->getSection('database')['password']
            );
            $this->pdo->query('SET NAMES UTF8;');
        }

        return $this->pdo;
    }

    public function getViewRenderer(): ViewRenderer
    {
        if (!$this->viewRenderer) {
            $this->viewRenderer = new PhpViewRenderer(
                $this->configuration->getSection('templating')['viewsDirectory'],
                $this->configuration->getSection('templating')['layoutPath']
            );
        }

        return $this->viewRenderer;
    }

    public function getAuthenticationContext(): AuthenticationContext
    {
        if (!$this->authenticationContext) {
            $this->authenticationContext = new AuthenticationContext($this->getSession());
        }

        return $this->authenticationContext;
    }

    public function getAccountAuthenticator(): AccountAuthenticator
    {
        if (!$this->accountAuthenticator) {
            $this->accountAuthenticator = new AccountAuthenticator(
                $this->getAccountProvider(),
                $this->getPasswordEncoder(),
                $this->getSession()
            );
        }

        return $this->accountAuthenticator;
    }

    public function getSession(): Session
    {
        if (!$this->session) {
            $this->session = new NativeSession();
        }

        return $this->session;
    }

    public function getMemberRepository(): MemberRepository
    {
        if (!$this->memberRepository) {

            $this->memberRepository = new InMemoryMemberRepository();
            $this->memberRepository = new PdoMemberRepository($this->getDatabase());
        }

        return $this->memberRepository;
    }

    public function getConferenceRepository(): ConferenceRepository
    {
        if (!$this->conferenceRepository) {

            $this->conferenceRepository = new InMemoryConferenceRepository();
        }

        return $this->conferenceRepository;
    }

    public function getAccountProvider(): AccountProvider
    {
        if (!$this->accountProvider) {
            $this->accountProvider = new MemberAccountProvider(
                $this->getMemberRepository()
            );
        }

        return $this->accountProvider;
    }

    public function getPasswordEncoder(): PasswordEncoder
    {
        if (!$this->passwordEncoder) {

            $this->passwordEncoder = new Sha1PasswordEncoder(10);
        }
        return $this->passwordEncoder;
    }
}
