<?php

namespace Boskee\EsendexBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boskee\EsendexBundle\Model\Message;
use Boskee\EsendexBundle\Model\VoiceMessage;
use Boskee\EsendexBundle\Model\TextMessage;
use Boskee\EsendexBundle\Form\VoiceMessageType;
use Boskee\EsendexBundle\Form\TextMessageType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BoskeeEsendexBundle:TextMessage:index.html.twig');
    }

    public function newAction($type)
    {
        if ($type == 'text')
        {
            $entity = new TextMessage();
        }
        else if ($type == 'voice')
        {
            $entity = new VoiceMessage();
        }
        $form = $this->createCreateForm($entity);

        return $this->render('BoskeeEsendexBundle:TextMessage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Office entity.
     *
     */
    public function createAction(Request $request, $type)
    {
        if ($type == 'text')
        {
            $entity = new TextMessage();
        }
        else if ($type == 'voice')
        {
            $entity = new VoiceMessage();
        }
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
	    	$service = $this->get('boskee_esendex.dispatcher');
			$result = $service->send($entity->prepare());

            return $this->redirect($this->generateUrl('boskee_esendex_text_message'));
        }

        return $this->render('BoskeeEsendexBundle:TextMessage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a TextMessage entity.
    *
    * @param TextMessage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Message $entity)
    {
        $formType = null;
        $entityType = null;
        if (get_class($entity) == 'Boskee\EsendexBundle\Model\VoiceMessage')
        {
            $formType = new VoiceMessageType();
            $entityType = 'voice';
        }
        else if (get_class($entity) == 'Boskee\EsendexBundle\Model\TextMessage')
        {
            $formType = new TextMessageType();
            $entityType = 'text';
        }

        $form = $this->createForm($formType, $entity, array(
            'action' => $this->generateUrl('boskee_esendex_text_message_create', array(
                'type' => $entityType
            )),
            'method' => 'POST'
        ));

        $form->add('submit', 'submit', array('label' => 'Send message'));

        return $form;
    }
}