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
 * Time: 5:10 PM
 */

namespace ZND\SIM\ApiBundle\Paginator;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class ApiPaginator
 *
 * @package Event\ApiBundle\Paginator
 * @DI\Service("events_api.api_paginator")
 */
class ApiPaginator implements ApiPaginatorInterface
{

    /**
     * @param $page
     * @param $limit
     *
     * @return float|int
     */
    public function getOffset($page, $limit){
       return abs($page) >1 ?ceil((int)$page*(int)$limit): 0;
    }

    /**
     * @param $count
     * @param $limit
     *
     * @return float
     *
     */
    public function getTotalPage($count, $limit){
       return $count>1 ?ceil((int)$count/(int)$limit):1;
    }

}