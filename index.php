<?php

include 'DatabaseHandler.php';
include 'resultHandling.php';

$date = date('d.m.Y');
//save url contents
function pullCNBdata() {

  global $date;
  $rawResults = file_get_contents('http://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt?date='.$date);
  //if the call fails, throw an exception
  if (!isset($rawResults)){
    throw new Exception("Error Downloading relevant data from the CNB API", 1);
  }

  return $rawResults;
}

// check the data?
try {

  $rawResults = pullCNBdata();

  //echo $rawResults;
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$processedResults = prepareForTransaction($rawResults);
//  var_dump($processedResults);
// create the handler, save the data to the database
$bot = new DatabaseHandler;

function createTableForTheDay () {
  $arguments ="countryCode VARCHAR(3)  PRIMARY KEY, currency VARCHAR(10), country VARCHAR(20), amount TINYINT(3), exchangeRate DECIMAL(6,3)";
  $type = "TABLE";
  $name = 'date'.$date = date('d_m_Y');
  global $bot;
  $bot->createObject($type,$name,$arguments);
}
createTableForTheDay();


//var_dump($processedResults[1]);
foreach ($processedResults as $values) {
  $values = implode("','", $values);
  $arguments = "country,currency,amount,countryCode,exchangeRate";
  //var_dump($values);
  $name = 'date'.$date = date('d_m_Y');
  $bot->saveObject($name,$arguments,$values);
}
unset($values);






 ?>
