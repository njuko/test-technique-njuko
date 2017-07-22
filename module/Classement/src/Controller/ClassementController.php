<?php

namespace Classement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClassementController extends AbstractActionController
{
    public function indexAction()
    {

        /** TODO : Implementer les classements */
        
        $participant = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findAll();

        return new ViewModel();
    }
}
