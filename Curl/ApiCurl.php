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

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("events_api.api_curl")
 */
class ApiCurl implements ApiCurlInterface
{
    public function exec($url, $payload = null, $type = 'GET')
    {
        $url = trim($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        switch ($type) {
            case 'POST': $this->setPostCurl($ch, $payload); break;
            case 'PUT': $this->setPutCurl($ch, $payload); break;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec($ch);
        curl_close($ch);

        return $serverOutput;
    }


    private function setPostCurl($ch, $payload)
    {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->urlify($payload));
    }

    private function setPutCurl($ch, $payload)
    {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->urlify($payload));
    }

    private function urlify($payload)
    {
        $string = '';

        foreach ($payload as $key => $value) {
            $string .= $key.'='.$value.'&';
        }

        rtrim($string, '&');

        return $string;
    }
}
