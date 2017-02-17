<?php

namespace Participant;

use Application\Entity\Participant;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Participant\Form\ParticipantForm;
use Zend\ServiceManager\ServiceManager;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getFormElementConfig()
    {
        return array(
            "factories" => [
                'participant_form' => function (ServiceManager $serviceManager) {

                    /** @var EntityManager $entityManager */
                    $entityManager = $serviceManager->get("doctrine.entitymanager.orm_default");
                    /** @var \Zend\Form\Form $form */
                    $form = new ParticipantForm();

                    $form->setHydrator(new DoctrineHydrator($entityManager));
                    $form->setObject(new Participant());

                    return $form;
                },
            ]
        );
    }
}
