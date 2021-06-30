<?php
/*
* Use  checkRepeatedWords.php  (text version). 
* Write a function that takes a sentence, and check if there are repeated words. 
* The function then returns an array of the repeated words and the number of times the words repeat.
* Repeated words are words that occur multiple times in consecutive. 
* If there is no repeated word or the sentence is empty, return an empty array.
*/
function checkRepeatedWords($sentence)
{
   $result = []; 
   $str_array = explode(" ", $sentence);
   $str_array_count_values = array_count_values($str_array);
   foreach ($str_array_count_values as $key => $value){
        if ($value > 1)
            $result[] = $key;
   }
   return $result;
}
// array_keys(somearray) returns an array containing keys of somearray
// in_array(something, somearray) returns true if something exists in somearray
print_r(checkRepeatedWords("I will do more more practice and my bring my my my questions to class"));

?>