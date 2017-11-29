<?php
/**
 * Created by PhpStorm.
 * User: localgit
 * Date: 6/30/17
 * Time: 2:11 PM
 */

namespace ZND\SIM\ApiBundle\Util;


final class ApiLimit
{

    /**
     * @var integer
     */
    const API_FOLLOWING_LIST=20;

    /**
     * @var integer
     */
    const API_FOLLOWING_MIN_LIST=12;

    /**
     * @var integer
     */
    const  API_VOTERS_LIST_LIMIT=10;

    /**
     *@var integer
     * number of kernel on liste when called by request
     */
    const API_KERNEL_LIST_LIMIT= 10;

    /**
     * @var integer
     * number of activities on list by page
     */
    const API_ACTIVITY_LIST_LIMIT= 5;

    /**
     * @var integer
     * number of activities on list by page
     */
    const API_NOTIFICATION_LIST_LIMIT= 5;

    /**
     * @var integer
     * number of activities on list by page
     */
    const API_NOTIFICATION_NAVBAR_LIMIT= 10;

    /**
     * @var integer
     * number of activities on list by page
     */
    const API_EVENTS_LIST_LIMIT = 5;
}