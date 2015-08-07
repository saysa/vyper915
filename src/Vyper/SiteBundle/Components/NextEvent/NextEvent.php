<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 09/10/2014
 * Time: 11:09
 */

namespace Vyper\SiteBundle\Components\NextEvent;

class NextEvent {

    private $_eventDate;

    public function getEventDate() {return $this->_eventDate;}
    public function setEventDate($_eventDate) {$this->_eventDate = $_eventDate;}


    /**
     * Constructor : Initializes properties
     * @param string $_eventDate
     */
    public function initialize($_eventDate)
    {
        $this->setEventDate($_eventDate);
    }

    /**
     * Returns the remaining days before the event
     * @return number
     */
    public function getRemainingDays()
    {
        $event = $this->getEventDate()->getTimestamp();
        $today = time();
        $difference = $event - $today;

        return ceil($difference/86400);
    }

    /**
     * Returns the event date month on Jan, Feb format
     * @return string
     */
    public function getEventDateMonth()
    {
        setlocale (LC_TIME, 'fr_FR.utf8','fra');
        $event = $this->getEventDate()->getTimestamp();
        $month = ucfirst(strftime( "%b", $event ));
        $month = str_replace(".", "", $month);
        $month = substr($month, 0, 3);
        return $month;
    }

    /**
     * @return array
     */
    public function templateVar()
    {
        $r= array();
        $r['nextEvent_exists'] = "true";
        $r['nextEvent_dateMonth'] = $this->getEventDateMonth();
        $r['nextEvent_remainingDays'] = $this->getRemainingDays();

        return $r;
    }
} 