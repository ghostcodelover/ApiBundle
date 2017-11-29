<?php

/*
 * This file is part of the EventsUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZND\SIM\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ApiFormType
 *
 * @package ZND\SIM\ApiBundle\Form\Type
 */
abstract class ApiFormType extends AbstractType
{
    /**
     * @var string
     */
    protected $class;
    /**
     * @var string
     */
    protected $intention;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->class,
            'csrf_protection'=> false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
       return 'events_'.parent::getBlockPrefix();
    }
}
