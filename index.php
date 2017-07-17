<?php
// This script checks if its the first bussinessday of the Month and if the result is true,
// it will pull the data from the national bank and save it to the database.


//hollidays configuration


$date = new DateTimeImmutable();//Today Date Value which will be evaluated


//echo $date;
function shouldTheScriptBeRunToday($holidays,$date,) {

      include 'holidays.php';





$i = 0;

$date = new DateTime('first day of this month');
$evalFormat = $date->format('j.n.D.Y');
$scriptDay = explode('.',$evalFormat);
//var_dump($scriptDay);



while ($i<31) {

$isBussinessDay = true;

$i++;

switch ($scriptDay[2]) {
  case 'Mon':
  case 'Tue':
  case 'Wed':
  case 'Thr':
  case 'Fri':

// this function calculates Easter holidays





        foreach ($holidays as $key => $value) {
          if ($holidays[$key][0] == $scriptDay[0] && $holidays[$key][1] == $scriptDay[1]){
             $isBussinessDay = false;
          }

        }

  break;
  case 'Sat':
  case 'Sun':
    //exit
        $isBussinessDay = false;
  break;




}

if ($isBussinessDay == true) {

  return $date;

}

$date = $date->modify('+1 day');
$evalFormat = $date->format('j.n.D.Y');
$scriptDay = explode('.',$evalFormat);





}

return $scriptDay;

}
$scriptDay = isBussinessDay();



$scriptDay = $scriptDay->format('j.n.D.Y');
var_dump($scriptDay);
//$runDate = implode(".",$scriptDay);


var_dump($date);




if ($scriptDay == $date) {



include 'DatabaseHandler.php';
include 'resultHandling.php';
include 'script.php';


}


 ?>
