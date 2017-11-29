<?php
namespace ZND\SIM\ApiBundle\Form\Factory;

/**
 * api form creator
 *
 * @author Mukendi Emmanuel <mukendiemmanuel15@gmail.com>
 */
interface ApiFormFactoryInterface
{
    /**
     * @param       $type
     * @param null  $form
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function create($type, $form=null, array $options= array());

    /**
     * @param $name
     * @param $type
     * @param $data
     * @param $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public  function createForm($name, $type, $data, $options);
}
