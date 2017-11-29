<?php

/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

namespace ZND\SIM\ApiBundle\Util;
use ZND\USM\UserBundle\EntityManager\UserEntityManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class CodeGenerator
 *
 * @package ZND\SIM\UserBundle\Util
 * @DI\Service("events_api.api_util_code_generator")
 */
class CodeGenerator implements CodeGeneratorInterface
{
    protected $numeric = array('0','1','2','3','4','6','7','8','9');
    /**
     * @var UserEntityManagerInterface
     */
    protected $userManager;

    /**
     * TokenGenerator constructor.
     *
     * @param UserEntityManagerInterface $userManager
     * @DI\InjectParams({
     *     "userManager" = @DI\Inject("znd_usm_user.user_entity_manager")
     * })
     */
    public function __construct(UserEntityManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return string
     */
    public function generateToken()
    {
        $token = $this->getToken();
        while ($this->userManager->findUserByToken($token)){
            $token = $this->getToken();
        }
        return $token;
    }

    /**
     * @return string
     */
    private function getToken(){
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }


    /**
     * @return null|string
     */
    public function generateCode()
    {
        $code = $this->getCode();
        while ($this->userManager->findUserByToken($code)){
            $code= $this->getCode();
        }
        return $code;
    }

    /**
     * @param null $code
     *
     * @return null|string
     */
    private function getCode($code =null){
        for ($i=0; $i<=5; $i++){
             $code.= $i==2?'-':array_rand($this->numeric);
        }
        return $code;
    }
}
