<?php

namespace AppBundle\Controller;

use AppBundle\Forms\Types\TicketProposalPriceType;
use AppBundle\Forms\TicketProposalPrice;
use AppBundle\Forms\TicketSubmission;
use AppBundle\Forms\Types\TicketSubmissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Tiquette\Domain\Ticket;

class SalesController extends Controller
{
    public function submitTicketAction(Request $request): Response
    {
        $ticketSubmission = new TicketSubmission();

        $ticketSubmissionForm = $this->createForm(TicketSubmissionType::class, $ticketSubmission);

        if ($request->isMethod('POST')) {
            $ticketSubmissionForm->handleRequest($request);
            if ($ticketSubmissionForm->isSubmitted() && $ticketSubmissionForm->isValid()) {

                $ticket = $this->get('ticket_factory')->fromTicketSubmission($ticketSubmission);
                $this->get('repositories.ticket')->save($ticket);

                return $this->redirectToRoute('ticket_submission_successful');
            }
        }

        return $this->render('@App/Sales/submit_ticket.html.twig', ['ticketSubmissionForm' => $ticketSubmissionForm->createView()]);
    }

    public function ticketSubmissionSuccessfulAction(Request $request): Response
    {
        return $this->render('@App/Sales/ticket_submission_successful.html.twig');
    }

    public function listAllTicketsAction(Request $request): Response
    {
        $tickets = $this->get('repositories.ticket')->findAll();

        return $this->render('@App/Sales/list_all_tickets.html.twig', ['tickets' => $tickets]);
    }

    public function detailsTicketAction(Request $request,$id): Response
    {
        $ticket = $this->get('repositories.ticket')->findById($id);
        $TicketProposalPrice = new TicketProposalPrice();
        $TicketProposalPriceForm = $this->createForm(TicketProposalPriceType::class, $TicketProposalPrice);

        return $this->render('@App/Sales/details_ticket.html.twig', ['ticket' => $ticket, 'ticketProposalPriceForm' => $TicketProposalPriceForm->createView()]);
    }

}
