<?php

/******************************************************************************
 *   This file is part of the EventsCoreBundle package.                       *
 *                                                                            *
 *   (c) Events <http://events.cd/>                                           *
 *                                                                            *
 *   For the full copyright and license information, please view the LICENSE  *
 *   file that was distributed with this source code.                         *
 ******************************************************************************/

namespace ZND\SIM\ApiBundle\Persistence;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerDecorator;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

/**
 * @DI\Service("events_api.api_object_manager")
 */
class ApiObjectManager extends ObjectManagerDecorator implements ApiObjectManagerInterface
{
    use LoggerTrait;

    /**
     * @var bool
     */
    private $activateLog = false;

    /**
     * @var int
     */
    private $flushSuiteLevel = 0;
    /**
     * @var bool
     */
    private $supportsTransactions = false;
    /**
     * @var bool
     */
    private $hasEventManager = false;
    /**
     * @var bool
     */
    private $hasUnitOfWork = false;
    /**
     * @var bool
     */
    private $allowForceFlush;
    /**
     * @var bool
     */
    private $showFlushLevel;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor.
     *
     * @DI\InjectParams({
     *     "om" = @DI\Inject("doctrine.orm.entity_manager")
     * })
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->wrapped = $om;
        $this->activateLog = false;
        $this->supportsTransactions
            = $this->hasEventManager
            = $this->hasUnitOfWork
            = $om instanceof EntityManagerInterface;
        $this->allowForceFlush = true;
        $this->showFlushLevel = false;
    }



    /**
     * Checks if the underlying manager supports transactions.
     *
     * @return boolean
     */
    public function supportsTransactions()
    {
        return $this->supportsTransactions;
    }

    /**
     * Checks if the underlying manager has an event manager.
     *
     * @return boolean
     */
    public function hasEventManager()
    {
        return $this->hasEventManager;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getEntityManager(){
        return $this->wrapped;
    }

    /**
     * Checks if the underlying manager has an unit of work.
     *
     * @return boolean
     */
    public function hasUnitOfWork()
    {
        return $this->hasUnitOfWork;
    }

    /**
     * @inheritDoc
     *
     * This operation has no effect if one or more flush suite is active.
     */
    public function flush()
    {
        if ($this->flushSuiteLevel === 0) {
            if ($this->activateLog) $this->log('Flush was started.');
            parent::flush();
        }
    }

    /**
     * Starts a flush suite. Until the suite is ended by a call to "endFlushSuite",
     * all the flush operations are suspended. Flush suites can be nested, which means
     * that the flush takes place only when all the opened suites have been closed.
     */
    public function startFlushSuite()
    {
        ++$this->flushSuiteLevel;
        if ($this->activateLog && $this->showFlushLevel) $this->logFlushLevel();
    }

    /**
     * Ends a previously opened flush suite. If there is no other active suite,
     * a flush is performed.
     *
     * @throws NoFlushSuiteStartedException if no flush suite has been started
     */
    public function endFlushSuite()
    {
        if ($this->flushSuiteLevel === 0) {
            throw new NoFlushSuiteStartedException('No flush suite has been started');
        }

        $this->flushSuiteLevel;
        $this->flush();
        if ($this->activateLog && $this->showFlushLevel) $this->logFlushLevel();
    }

    /**
     * Forces a flush.
     */
    public function forceFlush()
    {
        if ($this->allowForceFlush) {
            if ($this->activateLog) $this->log('Flush was forced for level ' . $this->flushSuiteLevel. '.');
            parent::flush();
        }
    }

    /**
     * Returns an instance of a class.
     *
     * Note: this is a convenience method intended to ease unit testing, as objects
     * returned by this factory are mockable.
     *
     * @param string $class
     *
     * @return object
     *
     * @todo find a way to ensure that the class is a valid data class (e.g. by
     * using the getClassMetatadata method)
     */
    public function factory($class)
    {
        return new $class;
    }

    /**
     * Please be carefull if you remove the force flush...
     *
     * @param $bool
     */
    public function allowForceFlush($bool)
    {
        $this->allowForceFlush = $bool;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return $this
     */
    public function activateLog()
    {
        $this->activateLog = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableLog()
    {
        $this->activateLog = false;

        return $this;
    }

    public function showFlushLevel()
    {
        $this->showFlushLevel = true;
    }

    public function hideFlushLevel()
    {
        $this->showFlushLevel = false;
    }

    private function logFlushLevel()
    {
        $stack = debug_backtrace();
        foreach ($stack as $call) {
            if ($call['function'] === 'endFlushSuite' || $call['function'] === 'startFlushSuite') {
                $this->log('Function "' . $call['function'] . '" was called from file ' . $call['file'] . ' on line ' . $call['line'] . '.', LogLevel::DEBUG);
            }
        }
        $this->log('Flush level: ' . $this->flushSuiteLevel. '.');
    }

    /**
     * @param       $level
     * @param       $message
     * @param array $context
     */
    public function log($level, $message='', array $context = array()){

    }
}
