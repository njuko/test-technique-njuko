<?php

namespace Participant\Controller;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ParticipantControllerFactory implements FactoryInterface{

    /**
     * @param ContainerInterface $serviceManager
     * @param string $controllerName
     * @param array|null $options
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when creating a service
     * @throws ContainerException if any other error occurs
     * @return mixed
     */

    public function __invoke(ContainerInterface $serviceManager, $controllerName, array $options = null)
    {

        $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
        $formElementManager = $serviceManager->get('FormElementManager');

        return new $controllerName($entityManager, $formElementManager);
    }

}