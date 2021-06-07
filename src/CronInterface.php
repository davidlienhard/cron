<?php declare(strict_types=1);

/**
 * cron interface
 *
 * @package         Cron
 * @author          David Lienhard <github@lienhard.win>
 * @copyright       David Lienhard
 */

namespace DavidLienhard\Cron;

/**
 * basic Cron-class
 * allows to check if a given Cron-expression is due
 *
 * @author          David Lienhard <github@lienhard.win>
 * @copyright       David Lienhard
 */
interface CronInterface
{
    /**
     * checks if a given Cron expression is due to be run
     * accepts an optional date to be checked against. default is now
     *
     * @author          David Lienhard <github@lienhard.win>
     * @copyright       David Lienhard
     * @param           array           $data           the Cron expression to be checked
     * @param           string          $date           an optional date
     * @uses            Cron::isValid()
     */
    public static function isDue(array $data, string $date = "now") : bool;
}
