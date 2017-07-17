<?php

function calculateEaster ($year) {
  // calculates Easter Sunday...
  $easter = new DateTimeImmutable((StrFTime("%d.%m.%Y", easter_date(intval($year)))));

  $easterMonday = $easter->modify('+1 day');

  $easterFriday = $easter->modify('-2 day');

  return array($easterFriday, $easterMonday);

}
$easter = calculateEaster($year);

 $easter[0]->format('j n');
 
//Array with all the Czech National holidays

$holidays = array( array(1,1,'Den obnovy samostatného českého státu'),$easter[0]->,$easter[1],array(1,5,'Svátek práce'),array(8,5,'Den vítězství'),
            array(5,7,'Den slovanských věrozvěstů Cyrila a Metoděje'),array(6,7,'Den upálení mistra Jana Husa'), array(28,9,'Den české státnosti'),
            array(28,10,'Den vzniku samostatného československého státu'),
            array(17,11,'Den boje za svobodu a demokracii'),array(24,12,'Štědrý den'),array(25,12,'1. svátek vánoční'),array(26,12,'. svátek vánoční'));

?>
