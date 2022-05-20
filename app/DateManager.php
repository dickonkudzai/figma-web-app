<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateManager extends Model
{

    public static function getStringFromDate($date)
    {
        $string = $date['Y'] . "/" . $date['M'] . "/" . $date['D'] . " " . $date['H'] . ":" . $date['MIN'] . ":" .$date['S'];
        return $string;
    }
    public static function getDateTimeFormat()
    {
        return 'Y/m/d H:i:s';//DO NOT CHANGE THIS DATE FORMAT
    }
    public static function getCurrentDateString()
    {
        date_default_timezone_set("Africa/Harare");
        $date = date('Y-m-d H:i:s');//DO NOT CHANGE THIS DATE FORMAT
        return $date;
    }
    function getDateFromString($date)
    {

        date_default_timezone_set("Africa/Harare");
        $first = substr($date,0,strpos($date," "));

        $yearslipts = explode("/",$first);

        $dates = substr($date,strpos($date," ")+1,strlen($date));

        $dates = explode(":",$dates);

        $ret['Y'] = $yearslipts[0];
        $ret['M'] = $yearslipts[1];
        $ret['D'] = $yearslipts[2];
        $ret['H'] = $dates[0];
        $ret['MIN'] = $dates[1];
        $ret['S'] = $dates[2];

        return $ret;
    }
    function getAge($date_of_birth)
    {
        date_default_timezone_set("Africa/Harare");
        $a = new DateTime($date_of_birth);
        $b = new DateTime(getCurrentDateString());
        $interval = $a->diff($b);

        $years = $interval->format("%Y");

        return $years;
    }
    function getDaysBetween($date1,$date2)
    {
        date_default_timezone_set("Africa/Harare");
        $a = new DateTime($date1);
        $b = new DateTime($date2);
        $interval = $a->diff($b);


        $years = $interval->format("%Y");
        $months = $interval->format("%m");
        $days = $interval->format("%d");
        $hours = $interval->format("%h");
        $mins = $interval->format("%i");

        if($years==0)
            $years = "";
        else
        {
            if($years>1)
                $years = $years . " years";
            else
                $years = $years . " year";
        }

        if($months==0)
            $months = "";
        else
        {
            if($months>1)
                $months = $months . " months";
            else
                $months = $months . " month";
        }


        if($days == 0)
            $days = "";
        else
        {
            if($days>1)
                $days = $days . " days";
            else
                $days = $days . " day";
        }


        if($hours == 0)
            $hours = "";
        else
        {
            if($hours>1)
                $hours = $hours . " hours";
            else
                $hours = $hours . " hour";
        }

        if($mins == 0||($days!=0&&$hours!=0))
            $mins = "";
        else
        {
            if($mins>1)
                $mins = $mins . " minutes";
            else
                $mins = $mins . " minute";
        }


        if($years == "" && $days == "" && $hours==""&&$mins=="")
            return "A moment";

        return $years . " " . $months . " " . $days . " " . $hours . " " . $mins ;
    }
    function getDateSummary($date)
    {
        date_default_timezone_set("Africa/Harare");
        $time= date("H:i",strtotime($date));
        $time= $time . " hours on ";

        $date= date("d M Y",strtotime($date));

        return $time . $date;
    }
    function getDateSummarySmall($date)
    {
        date_default_timezone_set("Africa/Harare");
        $time= date("H:i",strtotime($date));

        $date= date("M,d",strtotime($date));

        return $time . " " . $date;
    }
    function dateGreaterThan($date_to_check,$current_date)
    {
        date_default_timezone_set("Africa/Harare");
        $milli_sec_one= date("U",strtotime($date_to_check));
        $milli_sec_two= date("U",strtotime($current_date));

        return $milli_sec_one > $milli_sec_two;
    }
}
