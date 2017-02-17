<?php

namespace User\Controller;

use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\FormElementManagerFactory;

class UserController extends AbstractActionController
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

        $participants = $entityManager->getRepository('Application\Entity\User')->findAll();

        return new ViewModel(
            array(
                "participants" => $participants
            )
        );

    }

    public function userFormAction(){

        $serviceManager = $this->getEvent()->getApplication()->getServiceManager();
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get("doctrine.entitymanager.orm_default");

        /** @var \Zend\Form\Form $form */
        $form = $serviceManager->get('FormElementManager')->get('user_form');

        $id = (int) $this->params()->fromRoute('id', 0);

        /** @var \Application\Entity\User $user */
        if (0 !== $id) {
            try {
                $user = $entityManager->getRepository('Application\Entity\User')->find($id);
                $form->bind($user);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute('user/list');
            }
        }

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }else{

            $user = $form->getData();

            /** TODO Modification Evenement (forcer pour le moment) */
            $event = $entityManager->getRepository('Application\Entity\Event')->find(1);
            $user->setEvent($event);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirect()->toRoute('user/list');

        }


    }

    public function generateBibNumbersAction(){

        return $this->redirect()->toRoute('user/list');

    }

    public function deleteAction(){

        return $this->redirect()->toRoute('user/list');

    }
}
