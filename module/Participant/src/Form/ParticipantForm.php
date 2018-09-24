<?php

namespace Participant\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ParticipantForm extends Form implements ObjectManagerAwareInterface
{
    protected $objectManager;

    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->setAttribute('class', 'form-horizontal');
        $this->init();
    }


    public function init()
    {
        $this->add([
            'name' => 'id',
            'type' => 'Hidden',
        ]);

        $this->add([
            'name'    => 'firstname',
            'type'    => 'Text',
            'options' => [
                'label' => 'Prénom',
            ],
        ]);

        $this->add([
            'name'    => 'lastname',
            'type'    => 'Text',
            'options' => [
                'label' => 'Nom',
            ],
        ]);

        $this->add([
            'name'    => 'sex',
            'type'    => 'Radio',
            'options'    => [
                'label'            => 'Sexe',
                'label_attributes' => ['class' => 'checkbox-inline'],
                'value_options'    => [
                    [
                        'value'      => 'male',
                        'label'      => 'Homme',
                    ],
                    [
                        'value'      => 'female',
                        'label'      => 'Femme',
                    ]
                ]
            ],
        ]);

        $this->add([
            'name'    => 'event',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => [
                'label'          => 'Evènement',
                'object_manager' => $this->getObjectManager(),
                'target_class'   => 'Application\Entity\Event',
                'property'       => 'name',
            ],
        ]);

        $this->add([
            'name'    => 'bib',
            'type'    => 'Number',
            'options' => [
                'label' => 'Numéro de Dossard',
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary',
                'value' => 'Sauvegarder'
            ],
        ]);
        parent::init();
    }


    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }
}
