<?php

namespace Participant\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\ViewModel;

class ParticipantController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function listAction()
    {
        $serviceManager = $this->getEvent()->getApplication()->getServiceManager();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get("doctrine.entitymanager.orm_default");

        $participants = $entityManager->getRepository('Application\Entity\Participant')->findAll();

        return new ViewModel(
            array(
                "participants" => $participants
            )
        );

    }

    public function participantFormAction(){

        $serviceManager = $this->getEvent()->getApplication()->getServiceManager();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get("doctrine.entitymanager.orm_default");

        /** @var \Zend\Form\Form $form */
        $form = $serviceManager->get('FormElementManager')->get('participant_form');

        $id = (int) $this->params()->fromRoute('id', 0);

        /** @var \Application\Entity\Participant $participant */
        if (0 !== $id) {
            try {
                $participant = $entityManager->getRepository('Application\Entity\Participant')->find($id);
                $form->bind($participant);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('participant/list');
            }
        }

        /** @var Request $request */
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }else{

            $participant = $form->getData();

            /** TODO Modification Evenement (forcer pour le moment) */
            /** @var \Application\Entity\Event $event */
            $event = $entityManager->getRepository('Application\Entity\Event')->find(1);
            $participant->setEvent($event);

            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirect()->toRoute('participant/list');

        }


    }

    public function generateBibNumbersAction(){

        return $this->redirect()->toRoute('participant/list');

    }

    public function deleteAction(){

        return $this->redirect()->toRoute('participant/list');

    }
}
