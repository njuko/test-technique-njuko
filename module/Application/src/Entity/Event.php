<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $name;

    /**
     * @var \Datetime $dateEvent
     * @ORM\Column(type="datetime")
     */
    protected $dateEvent;
    
    /**
     * @var \Datetime $tempsDePassage
     * @ORM\Column(type="datetime")
     */
    protected $TempsDePassage;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \Datetime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * @param \Datetime $dateEvent
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;
    }
    
    /**
     * @return \Datetime
     */
    public function getTempsDePassage()
    {
        return $this->tempsDePassage;
    }

    /**
     * @param \Datetime $TempsDePassage
     */
    public function setTempsDePassage($tempsDePassage)
    {
        $this->tempsDePassage = $tempsDePassage;
    }

}
