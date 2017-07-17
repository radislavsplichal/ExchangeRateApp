<?php

function calculateEaster ($year) {
  // calculates Easter Sunday...
  $easter = new DateTimeImmutable((StrFTime("%d.%m.%Y", easter_date(intval($year)))));

  $easterMonday = $easter->modify('+1 day');

  $easterFriday = $easter->modify('-2 day');

  return array($easterFriday, $easterMonday);

}
$easter = calculateEaster(2017);


 var_dump( $easter[0]->format('j,n'));
 var_dump( $easter[1]->format('j,n'));
 ?>
