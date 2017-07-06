<?php
function prepareForTransaction($rawResults) {
//$rawResults = preg_replace('/\.$/', '', $rawResults); //Remove dot at end if exists
$callResults = explode("\n", $rawResults); //split string into callResults seperated by ', '

// The following lines will remove values from the first two indexes.
unset($callResults[0]);
unset($callResults[1]);
// This line will re-set the indexes (the above just nullifies the values...) and make a     new callResults without the original first two slots.
$callResults = array_values($callResults);
// The following line will show the new content of the callResults
//var_dump($callResults);
array_pop($callResults);
//var_dump($callResults);

$results;
foreach ($callResults as $key) {
  $results[] = explode("|",$key);
  //var_dump($key);

}
unset($key);



foreach ($results as $value) {
  $value[4] = str_replace(",",".",$value[4]);
}


//var_dump($results);


return $results;
}


 ?>
