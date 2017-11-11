<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function homeAction(Request $request, $messageTransmission = "")
    {
        $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->add('identite', TextType::class)
            ->add('message', TextareaType::class)
            ->add('Envoyer', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            return $this->forward('AppBundle:Contact:send', array('data' => $data));
        }

        return $this->render("AppBundle:default:contact.html.twig", array('form' => $form->createView(),
            'messageTransmission' => $messageTransmission));
    }

    public function sendAction($data)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->get('kernel')->getEnvironment() . ' - Email de contact !')
            ->setFrom('send@example.com')
            ->setTo('falque.vincent1@gmail.com')
            ->setBody(
                $this->renderView(
                    'AppBundle:default:EmailTemplate.html.twig',
                    array('data' => $data)
                ),
                'text/html'
        );

        $result = $this->get('mailer')->send($message);

        $messageTransmission = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error !</strong> Le mail ne s'est pas envoyé.</div>";

        if ($result == 1) {
            $messageTransmission = "<div class=\"alert alert-success\" role=\"alert\"><strong>Success !</strong> Le mail s'est bien envoyé.</div>";
        }

        $request = new Request();

        return $this->forward("AppBundle:Contact:home", array('request' => $request,
            'messageTransmission' => $messageTransmission));

    }
}