<?php

/*
 * This file is part of the ApiUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZND\SIM\ApiBundle\Serializer;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializerInterface;

/**
 * @DI\Service("events_api.api_serializer")
 */
class ApiSerializer 
{
    protected $serializer;
    /**
     * @DI\InjectParams({
     *     "serializer"= @DI\Inject("jms_serializer")
     * })
     */
    public function __construct(SerializerInterface $serializer){
        $this->serializer= $serializer;
    }

    /**
     * @param        $object
     * @param string $format
     *
     * @return string
     */
    public function serialize($object, $format= 'json'){
      $data = $this->serializer->serialize($object, $format);
      return $data;
    }

    /**
     * @param $object
     *
     * @return string
     */
    public function deserialize($object){
      $data = $this->serializer->serialize($object, $form='json');
      return $data;
    }
}