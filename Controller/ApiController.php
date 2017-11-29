<?php
/*
 * This file is part of the EventsApiBundle package.
 *
 * (c) EventsInc <http://events.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZND\SIM\ApiBundle\Controller;

use ZND\SIM\ApiBundle\Paginator\ApiPaginatorInterface;
use ZND\USM\UserBundle\EntityManager\UserEntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the registration
 *
 * @author Mukendi emmanuel <mukendiemmanuel15@gmail.com>
 */
 class ApiController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @var EventDispatcherInterface $dispatcher
     * @DI\Inject("event_dispatcher")
     */
    protected $dispatcher;

    /**
     * @var ApiPaginatorInterface
     * @DI\Inject("events_api.api_paginator")
     */
    protected $paginator;

    /**
     * @var UserEntityManagerInterface
     * @DI\Inject("znd_usm_user.user_entity_manager")
     */
    protected $userManager;

    /**
     * @return null|\Symfony\Component\Security\Core\Authentication\Token\TokenInterface3
     *
     */
    protected  function getToken(){
        return $this->get('security.token_storage')->getToken();
    }

    /**
     * @return null|string
     */
    protected function getCsrfToken(){
        return $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue() : null;
    }

     protected function isAuthenticatedFullyAction()
     {
         if (in_array('IS_AUTHENTICATED_FULLY', $this->get('security.token_storage')->getToken()->getRoles())) {
             throw new AccessDeniedException();
         }
     }

     protected function isAuthenticatedAsAdminAction()
     {
         if (false === $this->get('security.token_storage')->isGranted('ROLE_ADMIN')) {
             throw new AccessDeniedException();
         }
     }

     protected function isAuthenticatedAsSuperAdminAction()
     {
         if (false === $this->get('security.token_storage')->isGranted('ROLE_SUPER_ADMIN')) {
             throw new AccessDeniedException();
         }
     }
}