<?php
$date = date('d.m.Y');
//save url contents
function pullCNBdata($date) {


  $rawResults = file_get_contents('http://www.cnb.cz/cs/financni_trhy/devizovy_trh/kurzy_devizoveho_trhu/denni_kurz.txt?date='.$date);
  //if the call fails, throw an exception
  if (!isset($rawResults)){
    throw new Exception("Error Downloading relevant data from the CNB API", 1);
  }

  return $rawResults;
}

// check the data?
try {

  $rawResults = pullCNBdata($date);

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
  $date = date('Y-m-d');
  $values = $date."','".implode("','", $values);
  $arguments = "date,country,currency,amount,countryCode,exchangeRate";
  //var_dump($values);
  try {
  $bot->saveObject("kurzy",$arguments,$values);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
}
unset($values);

?>
