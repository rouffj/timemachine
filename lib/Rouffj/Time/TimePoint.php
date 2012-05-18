<?php

namespace Rouffj\Time;

/**
 * @author Joseph Rouff <rouffj@gmail.com>
 */
class TimePoint
{
    protected $gmt;
    protected $farPast;
    protected $farFuture;

    protected $millisecondsFromEpoc;

    public function __contruct()
    {
        $this->gmt = new \DateTimeZone('UTC');
        $this->farPast = $this->atMidnightGMT(0001, 1, 1);
        $this->farFuture = $this->atMidnightGMT(9999, 9, 9);
    }

    /**
     * @param  integer $year
     * @param  integer $month
     * @param  integer $date
     * @return TimePoint
     */
    public static function atMidnightGMT($year, $month, $date)
    {
        return self::atMidnight($year, $month, $date, new \DateTimeZone('UTC'));
    }

    /**
     * @param  integer        $year
     * @param  integer        $month
     * @param  integer        $date
     * @param  \DateTimeZone  $zone
     * @return TimePoint
     */
    public static function atMidnight($year, $month, $date, \DateTimeZone $zone)
    {
        return self::at($year, $month, $date, 0, 0, 0, 0, $zone);
    }

    /**
     * @param  integer  $year
     * @param  integer  $month
     * @param  integer  $date
     * @param  integer  $hour
     * @param  integer  $minute
     * @param  integer $second
     * @param  integer $millisecond
     * @return TimePoint
     */
    public static function atGMT($year, $month, $date, $hour, $minute, $second = 0, $millisecond = 0)
    {
        return self::at($year, $month, $date, $hour, $minute, $second, $millisecond);
    }

    public static function at12hr($year, $month, $date, $hour, $am_pm, $minute, $second, $millisecond, \DateTimeZone $zone) {
        return self::at($year, $month, $date, self::convertedTo24hour($hour, $am_pm), $minute, $second, $millisecond, $zone);
    }

    private static function convertedTo24hour($hour, $am_pm) {
        $translatedAmPm = "AM" == ($am_pm) ? 0 : 12;
        $translatedAmPm -= ($hour == 12) ? 12 : 0;
        return $hour + $translatedAmPm;
    }

    /**
     * @param  integer        $year
     * @param  integer        $month
     * @param  integer        $date
     * @param  integer        $hour
     * @param  integer        $minute
     * @param  integer        $second
     * @param  integer        $millisecond
     * @param  \DateTimeZone $zone
     * @return TimePoint                     
     */
    public static function at($year, $month, $date, $hour, $minute, $second, $millisecond, \DateTimeZone $zone = null)
    {
        $calendar = new \DateTime('', $zone);
        $calendar->setDate($year, $month, $date);
        $calendar->setTime($hour, $minute, $second);

        return self::from($calendar);
    }

    /**
     * @param  string $dateString
     * @param  string $pattern
     * @return TimePoint
     */
    public static function parseGMTFrom($dateString, $pattern)
    {
        return self::parseFrom($dateString, $pattern, new \DateTimeZone('UTC'));
    }

    /**
     * @param  string        $dateString
     * @param  string        $pattern
     * @param  \DateTimeZone $zone
     * @return TimePoint      
     */
    public static function parseFrom($dateString, $pattern, \DateTimeZone $zone)
    {
        $format = new \DateTime($pattern);
        $format->setTimeZone($zone);
        $date = $format->format($dateString);
        return self::from($date);
    }

    /**
     * @param  \DateTime $date
     * @return TimePoint
     */
    public static function fromDateTime(\DateTime $date)
    {
        return self::from($date.getTimestamp());
    }

    /**
     * @param  integer $milliseconds
     * @return TimePoint
     */
    public static function from($milliseconds)
    {
        $result =  new TimePoint($milliseconds);

        return $result;
    }

    /**
     * @param integer $milliseconds [description]
     */
    protected function TimePoint($milliseconds)
    {
        $this->millisecondsFromEpoc = $milliseconds;
    }

    /**
     * @param  TimePoint $other [description]
     * @return boolean
     */
    public function equals(TimePoint $other)
    {
        return 
        //revisit: maybe use: Reflection.equalsOverClassAndNull(this, other)
            ($other instanceof TimePoint) &&
            ($other->millisecondsFromEpoc == $this->millisecondsFromEpoc);
    }

    /**
     * @return integer
     */
    public function hashCode()
    {
        return (int) $this->millisecondsFromEpoc;
    }

    /**
     * @param  DateTimeZone $zone
     * @return TimePoint
     */
    public function backToMidnight(\DateTimeZone $zone) {
        return $this->calendarDate($zone)->asTimeInterval($zone)->start();
    }

    /**
     * @param  \DateTimeZone $zone
     * @return CalendarDate
     */
    public function calendarDate(\DateTimeZone $zone) {
        return CalendarDate::from($this, $zone);
    }

    /**
     * @param  TimePoint     $other
     * @param  DateTimeZone  $zone
     * @return boolean
     */
    public function isSameDayAs(TimePoint $other, \DateTimeZone $zone)
    {
        return $this->calendarDate($zone)->equals($other->calendarDate($zone));
    }

    /**
     * @param string        $pattern
     * @param DateTimeZone  $zone
     * @return string
     */
    public function toString($pattern = null, \DateTimeZone $zone = null)
    {
        if (null !== $pattern && null !== $zone) {
            $format = new \DateTime($pattern);
            $format->setTimeZone($zone);
            return $format->format($this->asJavaUtilDate());
        }
        return $this->asJavaUtilDate()->toString();
    }

    /**
     * @param  TimePoint $other
     * @return boolean
     */
    public function isBefore(TimePoint $other) {
        return $this->millisecondsFromEpoc < $other->millisecondsFromEpoc;
    }

    /**
     * @param  TimePoint $other [description]
     * @return boolean          [description]
     */
    public function isAfter(TimePoint $other) {
        return $this->millisecondsFromEpoc > $other->millisecondsFromEpoc;
    }

    /**
     * @param  TimePoint $other
     * @return integer
     */
    public function compareTo(TimePoint $other) {
        $otherPoint = clone $other;
        if ($this->isBefore($otherPoint)) return -1;
        if ($this->isAfter($otherPoint)) return 1;
        return 0;
    }

<<<<<<< HEAD
    /**
     * @return TimePoint
     */
    public function nextDay() {
        return $this->plus(Duration::days(1));
    }

    /**
     * @return DateTime
     */
    public function asJavaUtilDate() {
        return new \DateTime($this->millisecondsFromEpoc);
    }

    /**
     * @param  \DateTimeZone $zone
     * @return \DateTime
     */
    public function asJavaCalendar(\DateTimeZone $zone = null) {
        if (null === $zone) {
            $zone = $this->gmt;
        }
        $result = new \DateTime('', $zone);
        $result->setTimestamp($this->asJavaUtilDate()->getTimestamp());
        return $result;
=======
    public function equals(TimePoint $datetime)
    {
        return false;
>>>>>>> c222bfaa71320744d1ef8fc0d8f68a0754f68b02
    }

    public function isBeforeInterval(TimeInterval $interval)
    {
        return $interval->isAfter($this);
    }

    public function isAfterInterval(TimeInterval $interval) {
        return $interval->isBefore($this);
    }
    
    public function plus(Duration $duration) {
        return $duration->addedTo($this);
    }

    public function minus(Duration $duration) {
        return $duration->subtractedFrom($this);
    }

    public function until(TimePoint $end) {
        return TimeInterval::over($this, $end);
    }

    private function getMillisecondsFromEpocForPersistentMapping() {
        return $this->millisecondsFromEpoc;
    }

    private function setMillisecondsFromEpocForPersistentMapping($millisecondsFromEpoc) {
        $this->millisecondsFromEpoc = $millisecondsFromEpoc;
    }
}
