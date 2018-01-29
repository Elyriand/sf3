<?php

namespace AppBundle\Controller;

use AppBundle\Forms\TicketSubmission;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Tiquette\Domain\Ticket;
use Tiquette\Infrastructure\Repositories\InMemoryTicketRepository;

class SalesController extends Controller
{
    public function submitTicketAction(Request $request): Response
    {
        $ticketSubmission = new TicketSubmission();
        $ticketSubmission->eventName = $request->request->get('event_name');
        $ticketSubmission->eventDescription = $request->request->get('event_description');
        $ticketSubmission->eventDate = $request->request->get('event_date');

        if ($request->isMethod('POST')) {
            $violations = $this->get('validator')->validate($ticketSubmission);
            if (\count($violations) > 0) {

                /** @var ConstraintViolation[] $violations */
                return $this->render('@App/Sales/submit_ticket.html.twig', ['violations' => $violations]);
            }

            $ticket = Ticket::submit(
                $ticketSubmission->eventName,
                \DateTimeImmutable::createFromFormat('Y-m-d\TH:m', $ticketSubmission->eventDate),
                $ticketSubmission->eventDescription,
                0
            );

            $this->get('repositories.ticket')->save($ticket);

            return $this->redirectToRoute('ticket_submission_successful');
        }

        return $this->render('@App/Sales/submit_ticket.html.twig', ['violations' => []]);
    }

    public function ticketSubmissionSuccessfulAction(Request $request): Response
    {
        return $this->render('@App/Sales/ticket_submission_successful.html.twig');
    }
}
