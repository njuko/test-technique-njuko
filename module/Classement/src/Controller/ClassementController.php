<?php

namespace Classement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClassementController extends AbstractActionController
{
    public function indexAction()
    {

        /** TODO : Implementer les classements */
        
        $participants = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findAll($tri, SORT_STRING);
        $participantM = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findOneBy('sex' = 'male');
        $participantF = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findOneBy('sex' = 'female');

        return new ViewModel();
    }
    
    public function triAction()
    {
        $tri = $this->getRequest()->getParam('parameters');
        $participants = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findAll($tri, SORT_STRING);
        $participantM = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findOneBy('sex' = 'male');
        $participantF = $this-> entityManager-> getRepository('Application/Entity/Participant')-> findOneBy('sex' = 'female');
        
        return new ViewModel();
    
    }
}
