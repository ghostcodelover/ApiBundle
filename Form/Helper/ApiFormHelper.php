<?php

namespace ZND\SIM\ApiBundle\Form\Helper;

/**
 *
 * @author mukendi emmanuel <mukendiemmanuel@events.cd>
 */
abstract class ApiFormHelper
{
    /**
     * @var string[]
     */
    private static $maps = array(
        'Symfony\Component\Form\Extension\Core\Type\EmailType' => 'email',
        'Symfony\Component\Form\Extension\Core\Type\IntegerType' => 'integer',
        'Symfony\Component\Form\Extension\Core\Type\PasswordType' => 'password',
        'Symfony\Component\Form\Extension\Core\Type\TextType' => 'text',
        'Symfony\Component\Form\Extension\Core\Type\ChoiceType'=>'choices',
        'Symfony\Component\Form\Extension\Core\Type\DateType'=>'date' ,
        'Symfony\Component\Form\Extension\Core\Type\CountryType'=>'country',
        'Symfony\Component\Form\Extension\Core\Type\CheckboxType'=>'checkbox',
        'Symfony\Component\Form\Extension\Core\Type\RepeatedType'=>'repeated',
        'Symfony\Component\Form\Extension\Core\Type\BirthdayType'=>'berth_day',
        'Symfony\Component\Form\Extension\Core\Type\HiddenType' =>'hidden',
    );

    /**
     * @param $class
     *
     * @return mixed
     */
    public static function getType($class)
    {
        if (!self::isLegacy()) {
            return $class;
        }

        if (!isset(self::$maps[$class])) {
            throw new \InvalidArgumentException(sprintf('Form type with class "%s" can not be found. Please check for typos or add it to the map in LegacyFormHelper', $class));
        }

        return self::$maps[$class];
    }

    /**
     * @return bool
     */
    public static function isLegacy()
    {
        return !method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');
    }

    /**
     * ApiFormHelper constructor.
     *
     * @param $map  array
     */
    public function __construct(array $map)
    {
        if (!empty($map)){
            array_merge(self::$maps, $map);
        }
    }
}
