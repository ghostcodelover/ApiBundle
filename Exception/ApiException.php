<?php

/*
 * This file is part of the FOSRestBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZND\SIM\ApiBundle\Exception;

/**
 * List of Exeption response.
 *
 * @author Mukendi Ntenda Emmanuel
 */
class ApiException extends \Exception
{
    const NOT_ALLOWED_USER = 'vous n\'etes pas autoriser a effectuer cette action';
    const NOT_FOUND_RESOURCE= 'la ressource demande est introuvable';
}
