<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

class CandidatesController
{
    public function sayHello(Request $request): Response
    {
        return new Response(sprintf('<p>Hello %s</p>', $request->getQuery()->get('name', 'Anonymous')));
    }

    public function disBonjour(Request $request): Response
    {
        return sprintf('<p>Bonjour %s</p>', $request->getQuery()->get('name', 'Anonyme'));
    }

    public  function retrieveMemberList(Request $request): Response
    {
        $members = [
            ['name' => 'Boris', 'birthday' => '1984-08-21']
        ];
        $content = sprintf('<p>Affiche la liste des membres</p>');
        foreach ($members as $member) {
            $content .= sprintf('<li>%s</li>', $member['name']);
        }

        return new Response($content);
    }
}
