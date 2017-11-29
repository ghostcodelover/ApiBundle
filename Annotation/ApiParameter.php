<?php
/**
 * Created by PhpStorm.
 * User: localgit
 * Date: 7/1/17
 * Time: 10:15 AM
 */

namespace Event\ApiBundle\Annotation;

use JMS\DiExtraBundle\Annotation\MetadataProcessorInterface;
use JMS\DiExtraBundle\Metadata\ClassMetadata;

/**
 * @Annotation
 */
class ApiParameter implements MetadataProcessorInterface
{
    public $parameter;

    public function processMetadata(ClassMetadata $metadata)
    {
        // ...
    }
}