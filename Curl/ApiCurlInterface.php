<?php

/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

namespace ZND\SIM\ApiBundle\Curl;

interface ApiCurlInterface
{
    /**
     * @param        $url
     * @param null   $payload
     * @param string $method
     *
     * @return mixed
     * @internal param string $type
     */
    public function exec($url, $payload = null, $method = 'GET');
}
