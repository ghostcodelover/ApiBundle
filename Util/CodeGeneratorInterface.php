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

/**
 * Interface CodeGeneratorInterface
 *
 * @package ZND\SIM\UserBundle\Util
 */
interface CodeGeneratorInterface
{
    /**
     * @return string
     */
    public function generateToken();

    /**
     * @return null|string
     */
    public function generateCode();
}
