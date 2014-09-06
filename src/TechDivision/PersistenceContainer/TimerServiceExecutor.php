<?php

/**
 * TechDivision\PersistenceContainer\TimerServiceExecutor
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   TechDivision_PersistenceContainer
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_PersistenceContainer
 * @link      http://www.appserver.io
 */

namespace TechDivision\PersistenceContainer;

use TechDivision\Storage\GenericStackable;

/**
 * The executor thread for the timers.
 *
 * @category  Library
 * @package   TechDivision_PersistenceContainer
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_PersistenceContainer
 * @link      http://www.appserver.io
 */
class TimerServiceExecutor extends \Thread
{

    /**
     * Contains the scheduled timer tasks.
     *
     * @var \TechDivision\Storage\GenericStackable
     */
    protected $scheduledTimerTasks;

    /**
     * Initializes the queue worker with the application and the storage it should work on.
     */
    public function __construct()
    {

        // a collection with the schedule timer tasks
        $this->scheduledTimerTasks = new GenericStackable();

        // start the worker
        $this->start();
    }

    /**
     * Adds the passed timer task to the schedule.
     *
     * @param \Thread $timerTask The timer task to schedule
     *
     * @return void
     */
    public function schedule(\Thread $timerTask)
    {
        $this->scheduledTimerTasks[] = $timerTask;
    }

    /**
     * Only wait for executing timer tasks.
     *
     * @return void
     */
    public function run()
    {
        while (true) {
            $this->wait(1000000); // wait one second
        }
    }
}
