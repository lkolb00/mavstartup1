<?php


namespace App\Utility;


class StopWatch
{
    /**
     * @var $start float The start time of the StopWatch
     */
    private static $startTimes = array();

    /**
     * Start the timer
     *
     * @param $timerName string The name of the timer
     * @return void
     */
    public static function start($timerName = 'default-timer')
    {
        self::$startTimes[$timerName] = microtime(true);
    }

    /**
     * Get the elapsed time in seconds
     *
     * @param $timerName string The name of the timer to start
     * @return float The elapsed time since start() was called
     */
    public static function elapsed($timerName = 'default-timer')
    {
        return microtime(true) - self::$startTimes[$timerName];
    }

    /**
     * Clear all the timers
     *
     * @param none
     * @return void
     */
    public static function clearTimers()
    {
        self::$startTimes[] = array();
    }

}
