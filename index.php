<?php

include 'DatabaseHandler.php';
include 'resultHandling.php';


//save url contents
function pullCNBdata() {

  $rawResults = file_get_contents('http://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt?date=09.05.2017');
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




//var_dump($processedResults[1]);
foreach ($processedResults as $values) {
  $values = implode("','", $values);
  $arguments = "Country,Currency,Amount,Code,ExchangeRate";
  //var_dump($values);
  //$bot->saveObject("kurzy",$arguments,$values);
}
unset($values);






 ?>
