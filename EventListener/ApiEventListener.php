<?php
/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

namespace ZND\SIM\ApiBundle\EventListener;


use ZND\USM\UserBundle\Entity\UserInterface;
use ZND\USM\UserBundle\EntityManager\UserEntityManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class ApiEventListener
 *
 * @package ZND\SIM\ApiBundle\EventListener
 * @DI\Service("events_api.api_event_listener", public=true)
 */
abstract class ApiEventListener
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var UserEntityManagerInterface
     */
    protected $userManager;
    /**
     * ApiEventListener constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface|null      $container
     * @param \ZND\USM\UserBundle\EntityManager\UserEntityManagerInterface         $userManager
     * @DI\InjectParams({
     *      "container" = @DI\Inject("service_container"),
     *      "userManager" =@DI\Inject("znd_usm_user.user_entity_manager"),
     *      "activityManager" =@DI\Inject("events_activity.activity_entity_manager"),
     *     "imageManager" = @DI\Inject("events_media.image_entity_manager")
     *
     *})
     */
    public function __construct(
        ContainerInterface $container,
        UserEntityManagerInterface $userManager
    )
    {
        $this->container = $container;
        $this->userManager = $userManager;
        if (null!= $container){
            $this->dispatcher = $container->get('event_dispatcher');
            $this->session = $container->get('session');
        }

    }

    /**
     * @param FormInterface $form
     * @param Request       $request
     *
     * @param bool          $force
     *
     * @return bool|\Symfony\Component\Form\FormInterface
     */
    protected function process(FormInterface $form, Request $request,$force=true){
        $data = $request->request->all();
        $children = $form->all();
        $toBind = array_intersect_key($data, $children);
        foreach ($data as $key => $val){
           if(!array_key_exists($key,$toBind)){
               $request->request->remove($key);
           }
        }
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            return $form;
        }else if($force){
            return $this->forceSubmit($form, $request);
        }
        return $form;
    }

    /**
     * @param \Symfony\Component\Form\FormInterface     $form
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    protected function forceSubmit(FormInterface $form, Request $request){
        return $form->submit($request->request->all());
    }

    /**
     * @return mixed|UserInterface
     *
     */
    protected function getUser(){
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    protected function getter($source){
        return 'get'.$source;
    }

    protected function setter($source){
        return 'get'.$source;
    }
}