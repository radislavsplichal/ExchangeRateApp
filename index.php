<?php

//check if its bussinessday,1st day of the month and no hollidays are involved and no wild easter into the mix
$date = date('j.n.D.Y');
// day, month, year, day of the week, leap year?
//echo $date;
function isBussinessDay () {
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
        //proceed to the next test
        //Handling Easter hollidays
        $easter=(StrFTime("%d|%m|%Y", easter_date(intval($scriptDay[3]))));
        $easterFriday=explode('|',$easter);
        $easterFriday[0]=$easterFriday[0]-2;
        //var_dump($easterFriday);
        $easterMonday=explode('|',$easter);
        $easterMonday[0]=$easterMonday[0]+1;
        //var_dump($easterMonday);

        //Handling public hollidays
        $svatky = array( array(1,1,'Den obnovy samostatného českého státu'),$easterFriday,$easterMonday,array(1,5,'Svátek práce'),array(8,5,'Den vítězství'),
        array(5,7,'Den slovanských věrozvěstů Cyrila a Metoděje'),array(6,7,'Den upálení mistra Jana Husa'), array(28,9,'Den české státnosti'),
        array(28,10,'Den vzniku samostatného československého státu'),
        array(17,11,'Den boje za svobodu a demokracii'),array(24,12,'Štědrý den'),array(25,12,'1. svátek vánoční'),array(26,12,'. svátek vánoční'));

        foreach ($svatky as $key => $value) {
          if ($svatky[$key][0] == $scriptDay[0] && $svatky[$key][1] == $scriptDay[1]){
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
