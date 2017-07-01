<?php
setlocale(LC_ALL,'cs_CZ');
include 'Lilly.php';
//save url contents
$var = file_get_contents('http://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt?date=09.05.2017');
///echo $var;


//$var = preg_replace('/\.$/', '', $var); //Remove dot at end if exists
$array = explode("\n", $var); //split string into array seperated by ', '

// The following lines will remove values from the first two indexes.
unset($array[0]);
unset($array[1]);
// This line will re-set the indexes (the above just nullifies the values...) and make a     new array without the original first two slots.
$array = array_values($array);
// The following line will show the new content of the array
//var_dump($array);
for ($i=0; $i < count($array)-1; $i++) {
  $importArray[$i] = explode("|",$array[$i]);
  $importArray[$i][4]= str_replace(",",".",$importArray[$i][4],$count);
  echo $importArray[$i][4];
}


// create the handler, save the data to the database
$bot = new Lilly;
for ($i=0; $i < count($importArray)-1 ; $i++) {

  $values = implode("','", $importArray[$i]);
  //echo $values;
  $arguments = "Country,Currency,Amount,Code,ExchangeRate";

  $bot->saveObject("kurzy",$arguments,$values);



 }






 ?>
