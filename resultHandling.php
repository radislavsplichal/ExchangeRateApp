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

$processedResults;
foreach ($callResults as $key) {
  $processedResults[] = explode("|",$key);
  //var_dump($key);

}
unset($key);


foreach ($processedResults as $key => $values) {
  $processedResults[$key][0] = utf8_encode($values[0]);
  //var_dump($values[0]);
}
// foreach ($processedResults as $value) {
//   $value[4] = doubleval(str_replace(",",".",$value[4]));
//   //var_dump($value[4]);
// }
foreach ($processedResults as $key => $values) {
  $processedResults[$key][4] = floatval(str_replace(",",".",$values[4]));
  //var_dump($value[4]);
}
// echo $processedResults[2][4];

//var_dump($processedResults);


return $processedResults;
}


 ?>
