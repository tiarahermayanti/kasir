<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">

		/*******************************Calendar Top Navigation*********************************/
div#calendar{
margin:0px;
padding:0px;
width: 290px;
font-family:Helvetica, "Times New Roman", Times, serif;
}
div#calendar div.box{
position:relative;
top:0px;
left:0px;
width:100%;
height:40px;
background-color: #6600FF;
}
div#calendar div.header{
line-height:35px;
vertical-align:middle;
position:absolute;
left:11px;
top:0px;
width:260px;
height:35px;
text-align:center;
}
div#calendar div.header a.prev,div#calendar div.header a.next{
position:absolute;
top:0px;
height: 5px;
display:block;
cursor:pointer;
text-decoration:none;
color:#FFF;
}
div#calendar div.header span.title{
color:#FFF;
font-size:18px;
}

div#calendar div.header a.prev{
left:0px;
}
div#calendar div.header a.next{
right:0px;
}



/*******************************Calendar Content Cells*********************************/
div#calendar div.box-content{
border:1px solid #787878 ;
border-top:none;
}


div#calendar ul.label{
float:left;
margin: 0px;
padding: 0px;
margin-top:5px;
margin-left: 5px;
}
div#calendar ul.label li{
margin:0px;
padding:0px;
margin-right:6px;
float:left;
list-style-type:none;
width:34px;
height:40px;
line-height:40px;
vertical-align:middle;
text-align:center;
color:Green;
font-size: 15px;
background-color: transparent;
}

div#calendar ul.dates{
float:left;
margin: 0px;
padding: 0px;
margin-left: 5px;
margin-bottom: 5px;
}
/** overall width = width+padding-right**/
div#calendar ul.dates li{
margin:0px;
padding:0px;
margin-right:6px;
margin-top: 5px;
line-height:35px;
vertical-align:middle;
float:left;
list-style-type:none;
width:34px;
height:35px;
font-size:20px;
background-color: #1E90FF;
color:white;
text-align:center;
}
:focus{
outline:none;
}
div.clear{
clear:both;
}
	</style>
</head>
<body>
<?php
class Calendar {
	public function __construct() {
		$this->naviHref = htmlentities($_SERVER['PHP_SELF']);
	}
/********************* PROPERTY ********************/
	private $dayLabels = array("Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min");
	private $currentYear = 0;
	private $currentMonth = 0;
	private $currentDay = 0;
	private $currentDate = null;
	private $daysInMonth = 0;
	private $naviHref = null;
/********************* PUBLIC **********************/
/**
 * print out the calendar
 */
	public function show() {
		$year = date('Y');
		$month = null;
		if (null == $year && isset($_GET['year'])) {
			$year = $_GET['year'];
		} else if (null == $year) {
			$year = date("Y", time());
		}
		if (null == $month && isset($_GET['month'])) {
			$month = $_GET['month'];
		} else if (null == $month) {
			$month = date("m", time());
		}
		$this->currentYear = $year;
		$this->currentMonth = $month;
		$this->daysInMonth = $this->_daysInMonth($month, $year);
		$content = '<div id="calendar">' .
		'<div class="box">' .
		$this->_createNavi() .
		'</div>' .
		'<div class="box-content">' .
		'<ul class="label">' . $this->_createLabels() . '</ul>';
		$content .= '<div class="clear"></div>';
		$content .= '<ul class="dates">';
		$weeksInMonth = $this->_weeksInMonth($month, $year);
// Create weeks in a month
		for ($i = 0; $i < $weeksInMonth; $i++) {
//Create days in a week
			for ($j = 1; $j <= 7; $j++) {
				$content .= $this->_showDay($i * 7 + $j);
			}
		}
		$content .= '</ul>';
		$content .= '<div class="clear"></div>';
		$content .= '</div>';
		$content .= '</div>';
		return $content;
	}
/********************* PRIVATE **********************/
/**
 * create the li element for ul
 */
	private function _showDay($cellNumber) {
		if ($this->currentDay == 0) {
			$firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));
			if (intval($cellNumber) == intval($firstDayOfTheWeek)) {
				$this->currentDay = 1;
			}
		}
		if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {
			$this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));
			$cellContent = $this->currentDay;
			$this->currentDay++;
		} else {
			$this->currentDate = null;
			$cellContent = null;
		}

		return '<li id="li-' . $this->currentDate . '" class="' . ($cellNumber % 7 == 1 ? ' start ' : ($cellNumber % 7 == 0 ? ' end ' : ' ')) .
			($cellContent == null ? 'mask' : '') . '">' . $cellContent . '</li>';
	}
/**
 * create navigation
 */
	private function _createNavi() {
		$nextMonth = $this->currentMonth == 12 ? 1 : intval($this->currentMonth) + 1;
		$nextYear = $this->currentMonth == 12 ? intval($this->currentYear) + 1 : $this->currentYear;
		$preMonth = $this->currentMonth == 1 ? 12 : intval($this->currentMonth) - 1;
		$preYear = $this->currentMonth == 1 ? intval($this->currentYear) - 1 : $this->currentYear;
		return
		'<div class="header">' .
		'<a class="prev" href="' . $this->naviHref . '?month=' . sprintf('%02d', $preMonth) . '&year=' . $preYear . '">Prev</a>' .
		'<span class="title">' . date('Y M', strtotime($this->currentYear . '-' . $this->currentMonth . '-1')) . '</span>' .
		'<a class="next" href="' . $this->naviHref . '?month=' . sprintf("%02d", $nextMonth) . '&year=' . $nextYear . '">Next</a>' .
			'</div>';
	}
/**
 * create calendar week labels
 */
	private function _createLabels() {
		$content = '';
		foreach ($this->dayLabels as $index => $label) {
			$content .= '<li class="' . ($label == 6 ? 'end title' : 'start title') . ' title">' . $label . '</li>';
		}
		return $content;
	}

/**
 * calculate number of weeks in a particular month
 */
	private function _weeksInMonth($month = null, $year = null) {
		if (null == ($year)) {
			$year = date("Y", time());
		}
		if (null == ($month)) {
			$month = date("m", time());
		}
// find number of days in this month
		$daysInMonths = $this->_daysInMonth($month, $year);
		$numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);
		$monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));
		$monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));
		if ($monthEndingDay < $monthStartDay) {
			$numOfweeks++;
		}
		return $numOfweeks;
	}
/**
 * calculate number of days in a particular month
 */
	private function _daysInMonth($month = null, $year = null) {
		if (null == ($year)) {
			$year = date("Y", time());
		}

		if (null == ($month)) {
			$month = date("m", time());
		}

		return date('t', strtotime($year . '-' . $month . '-01'));
	}
}
$calendar = new Calendar();
echo $calendar->show();
?>
</body>
</html>