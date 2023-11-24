<?php
declare(strict_types=1);

/**
 * Builds and manipulate an events calendar
 * 
 * LICENSE: This source is subject to the MIT License, available
 * at  http://www.opensource.org/licenses/mit-license.html
 * 
 * @author      Jhonathan Sinzervhc <jhonathansin@hotmail.com>
 * @copyright   2023 Jhonathan Sinzervhc
 * @license     http://www.opensource.org/licenses/mit-license.html
 */

 class Calendar extends DB_Connect {
    /**
     * The date from which the calendar should be built
     * 
     * Store in YYY-MM-DD HH:MM:SS format
     * 
     * @var string the date to use for the calendar
     */
    private $_useDate;

    /**
     * The month for whici the calendar is being built
     * 
     * @var int the month being used
     */
    private $_m;

    /**
     * The year from which the month's start is selected
     * 
     * @var int the year being used
     */
    private $_y;

    /**
     * The number of days in the month being used
     * 
     * @var int the number os days in the month
     */
    private $_daysInMonth;

    /**
     * The index of the day of the week the month starts on (0-6)
     * 
     * @var int the day of the week the month starts on
     */
    private $_startDay;

    /**
     * Create a database object and stores relevant data
     * 
     * Upon instantiation, this class accepts a database object
     * that, if not null, is stored in the object's private $_db
     * property. If null, a new PDO object is created and stored
     * instead.
     * 
     * Additional info is dathered and stored in this method,
     * including the month from which the calendar is to be built,
     * how many days are in said month, what day the month starts
     * on, and what day it is currently.
     * 
     * @param object $dbo a database object
     * @param string $useDate the date to use to build the calendar
     * @return void
     */
    public function __construct($dbo=NULL, $useDate=NULL) {
        /*
         * Call the parent constructor to check for
         * a database object
         */
        parent::__construct($dbo);
        
        /*
         *  Gather and store data relevant to the month 
         */
        if (isset($useDate)) {
            $this->_useDate = $useDate;
        } else {
            $this->_useDate = date('Y-m-d H:i:s');
        }

        /*
         *  Conver to a timestamp, then determine the month
         * and year to use when building the calendar 
         */

        $ts = strtotime($this->_useDate);
        $this->_m = (int)date('m', $ts);
        $this->_y = (int)date('Y', $ts);

        /*
         * Determine how many days in the month 
         */
        $this->_daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->_m, $this->_y);
        
        /*
         *  Determine what weekday the month starts on 
         */
        $ts = mktime(0, 0, 0, $this->_m, 1, $this->_y);
        $this->_startDay = (int)date('w', $ts);
        }
 }

?>