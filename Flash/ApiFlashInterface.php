<?php
/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

namespace ZND\SIM\ApiBundle\Flash;

/**
 * Class UserFlashInfo
 *
 * @package ZND\SIM\UserBundle\FlashInfo
 */
interface ApiFlashInterface
{

    /**
     * @param       $messageId
     * @param       $domain
     * @param array $params
     *
     * @return bool
     * @internal param $translation
     * @internal param $successType
     */
    public function getMessage($messageId, $domain, array $params = []);

    /**
     * @param string $messageId
     * @param string $domain
     * @param array  $params
     *
     * @internal param string $translation
     */
    public function addMessage($messageId, $domain, array $params=[]);

    /**
     * @param array $domain
     */
    public function setDomain(array $domain= []);

    /**
     * @param array $messageIds
     */
    public function setMessageIds(array $messageIds=[]);
}