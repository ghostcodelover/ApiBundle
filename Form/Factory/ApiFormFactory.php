<?php
namespace ZND\SIM\ApiBundle\Form\Factory;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormFactoryInterface;


/**
 * User Manager implementation which can be used as base class for your
 * concrete manager.
 * @DI\Service("events_api.api_form_factory")
 * @author Mukendi emmanuel <mukendiemmanuel15@gmail.com>
 */

abstract class ApiFormFactory implements ApiFormFactoryInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

     public function __construct(FormFactoryInterface $formFactory)
     {
         $this->formFactory = $formFactory;
     }

    /**
     * @param       $type
     * @param null  $form
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($type, $form=null, array $options= array())
    {
        return $this->formFactory->create($type, $form, $options);
    }

    /**
     * @param $name
     * @param $type
     * @param $data
     * @param $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public  function createForm($name, $type, $data, $options){
        return $this->formFactory->createNamed($name,$type,$data, $options);
    }
}

