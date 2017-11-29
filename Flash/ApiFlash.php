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

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class UserFlashInfo
 *
 * @package ZND\SIM\UserBundle\FlashInfo
 * @DI\Service("events_api.api_flash")
 */
abstract class ApiFlash implements ApiFlashInterface
{
    /**
     * @var array
     */
    protected static $messageIds= ['welcome'=>'home.welcome'];

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var TranslatorInterface
     */
    protected $translator;
    /**
     * @var array
     */
    protected static $domains=[
        'default'=> 'EventsApiBundle',
        'success'=> 'EventsApiBundleSuccess',
        'error'  => 'EventsApiBundleError'
    ];

    /**
     * FlashListener constructor.
     *
     * @param Session             $session
     * @param TranslatorInterface $translator
     * @DI\InjectParams({
     *     "session"=@DI\Inject("session"),
     *     "translator" = @DI\Inject("translator")
     *     })
     */
    public function __construct(Session $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * @param       $messageId
     * @param       $domain
     * @param array $params
     *
     * @return bool
     * @internal param $translation
     * @internal param $successType
     */
    public function getMessage($messageId, $domain, array $params = []){
        if (!isset(self::$domains[$domain])){
            return 'erreur';
        }
        $domain = self::$domains[$domain];
        $messageId= self::$messageIds[$messageId]?self::$messageIds[$messageId]:'default';
        return $this->trans($messageId,$domain, $params);
    }

    /**
     * @param string $messageId
     * @param string $domain
     * @param array  $params
     *
     * @internal param string $translation
     */
    public function addMessage($messageId, $domain, array $params=[])
    {
        if (!isset(self::$messageIds[$messageId])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }
        $this->session->getFlashBag()->add($domain, $this->trans(self::$messageIds[$messageId],$domain, $params));
    }

    /**
     * @param array $domain
     */
    public function setDomain(array $domain= []){
        self::$domains=$domain;
    }

    /**
     * @param array $messageIds
     */
    public function setMessageIds(array $messageIds=[]){
        self::$messageIds= $messageIds;
    }

    /**
     * @param       $messageId
     * @param       $domain
     * @param array $params
     *
     * @return string
     * @internal param $translation
     * @internal param string $message
     */
    private function trans($messageId, $domain, array $params = [])
    {
        return $this->translator->trans($messageId,$params,$domain);
    }
}