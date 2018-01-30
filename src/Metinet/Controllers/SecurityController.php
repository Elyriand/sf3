<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Security\AuthenticationFailed;
use Metinet\Domain\Conferences\Email;

class SecurityController extends Controller
{
    public function login(Request $request): Response
    {
        if ($this->getAuthenticationContext()->isAccountLoggedIn()) {

            return new Response('Already logged-in !!');
        }

        if ($request->isPost()) {
            $email = $request->getRequest()->get('email');
            $password = $request->getRequest()->get('password');

            try {
                $this->controllerDependencies->getAccountAuthenticator()
                    ->authenticate(new Email($email), $password)
                ;
            } catch (AuthenticationFailed $e) {

                return new Response($this->render(
                    'loginFailed.html.php',
                    ['reason' => $e->getMessage()]
                ), 403);
            }

            return new Response($this->render(
                'successfulLogin.html.php',
                ['email' => $this->getAuthenticationContext()->getAccount()->getEmail()]
            ));

        }

        return new Response($this->render('login.html.php', [
            'email' => $email ?? '',
            'password' => $password ?? ''
        ]));
    }

    public function logout(Request $request): Response
    {
        $this->getAuthenticationContext()->logout();

        return new Response('', 303, ['Location' => '/login']);
    }
}
