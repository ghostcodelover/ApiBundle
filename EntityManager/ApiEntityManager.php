<?php
/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

namespace ZND\SIM\ApiBundle\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;
use ZND\SIM\ApiBundle\Persistence\ApiObjectManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class AbstractEntityManager
 *
 * @package Event\UserBundle\EntityManager
 * @DI\Service("events_api.api_entity_manager")
 */
abstract class ApiEntityManager
{
    /**
     * @var ApiObjectManagerInterface
     */
    protected $om;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @var string $class
     */
    protected $class;

    /**
     * AbstractEntityManager constructor.
     *
     * @param                           $class
     * @param ApiObjectManagerInterface $om
     */
    public function __construct(ApiObjectManagerInterface $om, $class )
    {
        $this->om = $om;
        $this->repository = $om->getRepository($class);
        $this->class = $om->getClassMetadata($class)->getName();
    }

    /**
     * @param string $class
     *
     * @return mixed
     */
    protected function factory($class=null){
        return null==$class ? new $this->class(): new $class();
    }

    /**
     * @param $class
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository($class){
        return $this->om->getRepository($class);
    }

    /**
     * @param $class
     *
     * @return string
     */
    protected function getClassMetaData($class){
        return $this->om->getClassMetadata($class)->getName();
    }
}