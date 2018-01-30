<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Domain\Members\MemberFactory;
use Metinet\FormValidation\MemberSignUp;

class MembersController extends Controller
{
    public function signUp(Request $request): Response
    {
        if ($this->getAuthenticationContext()->isAccountLoggedIn()) {

            return new Response('You are already logged-in, you cannot register');
        }

        $signUp = MemberSignUp::fromRequest($request);

        if ($request->isPost()) {

            if ($signUp->isValid()) {

                $memberFactory = new MemberFactory($this->controllerDependencies->getPasswordEncoder());
                $member = $memberFactory->fromSignUp($signUp);
                $this->controllerDependencies->getMemberRepository()->save($member);

                return new Response('', 303, ['Location' => '/login']);
            }

            $formErrors = $signUp->getErrors();
        }

        return new Response($this->render('members/signUp.html.php', [
            'errors' => $formErrors ?? [],
            'signUp' => $signUp
        ]));
    }
}
