<?php
/**
 * Created by PhpStorm.
 * User: localgit
 * Date: 6/30/17
 * Time: 9:46 PM
 */

namespace ZND\SIM\ApiBundle\Persistence;


use Doctrine\Common\Persistence\ObjectManager;

interface ApiObjectManagerInterface extends ObjectManager
{

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getEntityManager();
}