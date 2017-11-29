<?php
/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

/**
 * Created by PhpStorm.
 * User: localgit
 * Date: 2/21/17
 * Time: 12:20 PM
 */

namespace ZND\SIM\ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ApiRepostory
 *
 * @package Event\ApiBundle\Repository
 */
class ApiRepository extends EntityRepository
{
    /**
     * @var Query
     */
    protected $query;

    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param                            $offset
     * @param int                        $limit
     *
     * @return \Doctrine\ORM\Query
     * @internal param \Doctrine\ORM\QueryBuilder $query
     */
    protected function handle(QueryBuilder $queryBuilder, $offset, $limit=5){
        $query= $queryBuilder->setFirstResult($offset)->setMaxResults($limit);
        return $query->getQuery()->getResult();
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $query
     *
     * @return Query
     */
    protected function handleSingle(QueryBuilder $query){
        return $query->getQuery()->getSingleResult();
    }
}