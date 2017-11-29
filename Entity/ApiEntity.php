<?php
/**
 * Created by PhpStorm.
 * User: localgit
 * Date: 6/30/17
 * Time: 9:57 PM
 */

namespace ZND\SIM\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ApiEntity
 *
 * @package ZND\SIM\ApiBundle\Entity
 * @ORM\MappedSuperclass()
 */
abstract class ApiEntity
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}