<?php
/**
 * cron interface
 *
 * @package         Cron
 * @author          David Lienhard <david.lienhard@tourasia.ch>
 * @copyright       tourasia
 */

declare(strict_types=1);

namespace DavidLienhard\Cron;

/**
 * basic Cron-class
 * allows to check if a given Cron-expression is due
 *
 * @author          David Lienhard <david.lienhard@tourasia.ch>
 * @copyright       tourasia
 */
interface CronInterface
{
    /**
     * checks if a given Cron expression is due to be run
     * accepts an optional date to be checked against. default is now
     *
     * @author          David Lienhard <david.lienhard@tourasia.ch>
     * @copyright       tourasia
     * @param           array           $data           the Cron expression to be checked
     * @param           string          $date           an optional date
     * @return          bool
     * @uses            Cron::isValid()
     */
    public static function isDue(array $data, string $date = "now") : bool;
}
