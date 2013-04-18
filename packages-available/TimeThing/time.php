<?php
# Copyright (c) 2013, Kevin Sandom under the BSD License. See LICENSE for full details.

define('minutes', 60);
define('hours', 3600);
define('days', 86400);
define('weeks', 604800);
define('months', 2592000);
define('years', 31536000);
define('fuzzyTimeThreshold', 5*years);


class TimeThing extends Module
{
	private $track=null;
	private $store=null;
	private $codes=false;
	
	function __construct()
	{
		parent::__construct('TimeThing');
	}
	
	function event($event)
	{
		switch ($event)
		{
			case 'init':
				$this->core->registerFeature($this, array('now'), 'now', 'Put the current time in seconds into a store variable. --now=Category,variableName', array('time'));
				$this->core->registerFeature($this, array('timeDiff'), 'timeDiff', 'Put the difference of two times into a store variable. --timeDiff=Category,variableName,inputTime1,inputTime2 . inputTime 1 and 2 are time represented in seconds.', array('help'));
				$this->core->registerFeature($this, array('fuzzyTime'), 'fuzzyTime', 'Put the fuzzyTime (eg "5 hours") into a store variable. --fuzzyTime=Category,variableName,inputTime . inputTime is time represented in seconds.', array('help'));
				$this->core->registerFeature($this, array('fullTimeStamp'), 'fullTimeStamp', 'Put a full timestamp (eg "2013-04-17--20:12:10") into a store variable. --fullTimeStamp=Category,variableName,[inputTime][,format] . inputTime is time represented in seconds, and will default to now if omitted. format is defined in http://php.net/manual/en/function.date.php and defaults to ~!Settings,timestampFormat!~.', array('help'));
				break;
			case 'followup':
				break;
			case 'last':
				break;
			case 'now':
				$parms=$this->core->interpretParms($this->core->get('Global', $event), 2, 2, true);
				$this->core->set($parms[0], $parms[1], $this->now());
				break;
			case 'timeDiff':
				$parms=$this->core->interpretParms($this->core->get('Global', $event), 4, 4, true);
				$this->core->set($parms[0], $parms[1], $this->timeDiff($parms[2], $parms[3]));
				break;
			case 'fuzzyTime':
				$parms=$this->core->interpretParms($this->core->get('Global', $event), 3, 3, true);
				$this->core->set($parms[0], $parms[1], $this->fuzzyTime($parms[2]));
				break;
			case 'fullTimeStamp':
				$parms=$this->core->interpretParms($this->core->get('Global', $event), 4, 2, true);
				if ($parms[3]) $this->core->set($parms[0], $parms[1], $this->fullTimeStamp($parms[2], $parms[3]));
				else $this->core->set($parms[0], $parms[1], $this->fullTimeStamp($parms[2]));
				break;
			default:
				$this->core->complain($this, 'Unknown event', $event);
				break;
		}
	}
	
	function now()
	{
		return time();
	}
	
	function timeDiff($inputTime1, $inputTime2)
	{
		return $inputTime2-$inputTime1;
	}
	
	function fuzzyTime($inputTime)
	{
		if ($inputTime>fuzzyTimeThreshold)
		{
			return $this->fullTimeStamp($inputTime);
		}
		
		if ($inputTime<minutes)
		{
			$unit='second';
			$value=$inputTime;
		}
		else
		{
			if ($inputTime<hours)
			{
				$unit='minute';
				$value=round($inputTime/minutes);
			}
			else
			{
				if ($inputTime<days)
				{
					$unit='hour';
					$value=round($inputTime/hours);
				}
				else
				{
					if ($inputTime<weeks)
					{
						$unit='day';
						$value=round($inputTime/days);
					}
					else
					{
						if ($inputTime<months)
						{
							$unit='week';
							$value=round($inputTime/weeks);
						}
						else
						{
							if ($inputTime<years)
							{
								$unit='month';
								$value=round($inputTime/months);
							}
							else
							{
								$unit='year';
								$value=round($inputTime/years);
							}
						}
					}
				}
			}
		}
		
		$output="$value $unit";
		if (intval($value)!=1) $output.='s';
		return $output;
	}
	
	function fullTimeStamp($inputTime, $format='Y-m-d--G:i:s')
	{
		$time=($inputTime)?$inputTime:$this->now();
		return date($this->core->get('Settings','timestampFormat'), $time);
	}
}

$core=core::assert();
$core->registerModule(new TimeThing());
 
?>