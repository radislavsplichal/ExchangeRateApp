<?php
// This script checks if its the first bussinessday of the Month and if the result is true,
// it will pull the data from the national bank and save it to the database.

$todayDate = new DateTimeImmutable();//Today date value which will be evaluated
$year = $todayDate->format('Y');// for calculating easter
//hollidays configuration
include 'holidays.php';

function checkForWorkdays ($scriptDay) {
      switch ($scriptDay[2]) {

        case 'Mon':
        case 'Tue':
        case 'Wed':
        case 'Thr':
        case 'Fri':
              return $isBussinessDay = true;
          break;
        case 'Sat':
        case 'Sun':
              return $isBussinessDay = false;
          break;
        }
}

function checkForHolidays($holidays,$scriptDay){
      foreach ($holidays as $key => $value) {
              if ($holidays[$key][0] == $scriptDay[0] && $holidays[$key][1] == $scriptDay[1]){
                return $isBussinessDay = false;
              }
            }
      return $isBussinessDay = true;
}

//find the correct day for the month
function findFirstBussinessdayOfTheMonth ($holidays) {

  $date = new DateTimeImmutable('first day of this month');

  $i=0;
  while ($i<31) {
  $i++;

  $evalFormat = $date->format('j.n.D.Y');
  $scriptDay = explode('.',$evalFormat);

  $isBussinessDay = checkForWorkdays($scriptDay);
  $isNotHoliday = checkForHolidays($holidays,$scriptDay);

    if ($isBussinessDay == true && $isNotHoliday == true) {

      return $date;

    }

  $date = $date->modify('+1 day');
      }
}

function shouldTheScriptBeRunToday($todayDate,$scriptDay) {
$scriptDay = $scriptDay->format('j.n.D.Y');
$todayDate = $todayDate->format('j.n.D.Y');

var_dump($scriptDay);
var_dump($todayDate);

  if ($scriptDay == $todayDate) {

    include 'databaseHandler.php';
    include 'resultHandling.php';
    include 'pullData.php';
    return true;
  } else {
    return false;
  }

}
//the day its ok to run the script
$scriptDay = findFirstBussinessdayOfTheMonth($holidays);
$response = shouldTheScriptBeRunToday($todayDate,$scriptDay);
//work test
var_dump( $response);

 ?>
