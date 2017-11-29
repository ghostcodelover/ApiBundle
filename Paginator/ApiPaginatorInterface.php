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

/**
 * Class ApiPaginator
 *
 * @package Event\ApiBundle\Paginator
 */
interface ApiPaginatorInterface
{

    /**
     * @param $page
     * @param $limit
     *
     * @return float|int
     */
    public function getOffset($page, $limit);

    /**
     * @param $count
     * @param $limit
     *
     * @return float
     */
    public function getTotalPage($count, $limit);
}