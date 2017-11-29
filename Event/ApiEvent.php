<?php

namespace ZND\SIM\ApiBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiFormEvent
 *
 * @package ZND\SIM\ApiBundle\Event
 */
abstract class ApiEvent extends Event
{
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $role;

    /**
     * FormEvent constructor.
     *
     * @param FormInterface                              $form
     * @param Request                                    $request
     * @param Response                                   $response
     */
    public function __construct(FormInterface $form=null, Request $request=null, Response $response=null)
    {
        $this->form = $form;
        $this->request = $request;
        $this->response = $response;
        $this->status = null;
        $this->role = null;
    }

    /**
     * @param FormInterface $form
     * @return FormInterface
     */
    public function setForm(FormInterface $form)
    {
        return $this->form = $form;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $request Request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param int $status
     * @return int $status
     */
    public function setStatus($status)
    {
        return $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
}
