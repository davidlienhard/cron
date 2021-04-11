<?php
/**
 * class to check Cron-expressions
 *
 * @package         Cron
 * @author          David Lienhard <david.lienhard@tourasia.ch>
 * @version         1.0.1, 17.11.2020
 * @since           1.0.0, 16.11.2020, created
 * @copyright       tourasia
 */

declare(strict_types=1);

namespace DavidLienhard\Cron;

use \DavidLienhard\Cron\CronInterface;

/**
 * basic Cron-class
 * allows to check if a given Cron-expression is due
 *
 * @author          David Lienhard <david.lienhard@tourasia.ch>
 * @version         1.0.1, 17.11.2020
 * @since           1.0.0, 16.11.2020, created
 * @copyright       tourasia
 */
class Cron implements CronInterface
{
    /**
     * checks if a given Cron expression is due to be run
     * accepts an optional date to be checked against. default is now
     *
     * @author          David Lienhard <david.lienhard@tourasia.ch>
     * @version         1.0.0, 16.11.2020
     * @since           1.0.0, 16.11.2020, created
     * @copyright       tourasia
     * @param           array           $data           the Cron expression to be checked
     * @param           string          $date           an optional date
     * @uses            Cron::isValid()
     */
    public static function isDue(array $data, string $date = "now") : bool
    {
        $isDue = true;
        $time = strtotime($date);

        if ($time === false) {
            $time = time();
        }

        // MINUTES
        if (isset($data['minute']) && trim($data['minute']) != "") {
            if (!self::isValid($data['minute'], intval(date("i", $time)), 60)) {
                $isDue = false;
            }
        }

        // HOURS
        if (isset($data['hour']) && trim($data['hour']) != "") {
            if (!self::isValid($data['hour'], intval(date("G", $time)), 60)) {
                $isDue = false;
            }
        }

        // DAYS
        if (isset($data['day']) && trim($data['day']) != "") {
            if (!self::isValid($data['day'], intval(date("j", $time)), 31)) {
                $isDue = false;
            }
        }

        // MONTHS
        if (isset($data['month']) && trim($data['month']) != "") {
            if (!self::isValid($data['month'], intval(date("n", $time)), 12)) {
                $isDue = false;
            }
        }

        // YEARS
        if (isset($data['year']) && trim($data['year']) != "") {
            if (!self::isValid($data['year'], intval(date("Y", $time)), 7)) {
                $isDue = false;
            }
        }

        // DAYS OF WEEK
        if (isset($data['dayOfWeek']) && trim($data['dayOfWeek']) != "") {
            if (!self::isValid($data['dayOfWeek'], intval(date("w", $time)), 7)) {
                $isDue = false;
            }
        }

        return $isDue;
    }


    /**
     * checks if a given Cron expression is valid
     * supports ranges, increments and lists but no combinations
     *
     * @author          David Lienhard <david.lienhard@tourasia.ch>
     * @version         1.0.0, 16.11.2020
     * @since           1.0.0, 16.11.2020, created
     * @copyright       tourasia
     * @param           string          $expression     the expression to be checked
     * @param           int             $needle         the needle to be checked against
     * @param           int             $maxValue       maximal allowed value for the increments
     */
    private static function isValid(string $expression, int $needle, int $maxValue) : bool
    {
        $needle = intval($needle);

        $hasRange = strpos($expression, "-");
        $hasIncrements = strpos($expression, "/");
        $hasList = strpos($expression, ",");

        // RANGES (1-5)
        if ($hasRange) {
            list($from, $to) = array_map("intVal", explode("-", $expression));
            return ($needle >= $from && $needle <= $to);
        }

        // INCREMENTS (*/5)
        if ($hasIncrements) {
            list($base, $increment) = array_map("trim", explode("/", $expression));
            $increment = intval($increment);

            if ($increment == 0) {
                return false;
            }

            if ($base == "*") {
                $base = 0;
            }

            if ($base > $maxValue) {
                $base = $maxValue;
            }

            $list = [];
            for ($i = $base; $i < $maxValue; $i += $increment) {
                $list[] = $i;
            }

            return in_array($needle, $list);
        }//end if

        // LISTS (1,3,4)
        if ($hasList) {
            $list = array_map("intVal", explode(",", $expression));
            return in_array($needle, $list);
        }

        // SIMPLE EXPRESSION (5)
        return intval($expression) == $needle;
    }
}
