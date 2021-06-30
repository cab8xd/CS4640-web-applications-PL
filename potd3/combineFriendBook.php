<?php

function merge_books($book1, $book2)
{
    $merged_book = $book1;
    foreach ($book2 as $key => $value)
    {
        echo in_array($key, array_keys($merged_book)); // 1: true, "": false
        if(in_array($key, array_keys($merged_book)))
            $merged_book[$key] = [$merged_book[$key], $value];
        else
            $merged_book[$key] = [$value];
    }
    return to_string($merged_book);
}

function to_string($array)
{
    foreach($array as $key => $array_value)
    {
        echo "$key : [ ";
        if (gettype($array_value) == "array")
        {
            for ($i=0; $i<sizeof($array_value); $i++) // or count($array_value)
            {
                echo $array_value[$i];
                if ($i < count($array_value) - 1)
                    echo ", ";
            }
            echo " ] <br/>"; 
        }
        else
            echo $array_value, " ] <br/>";
    }
}

// array_keys(somearray) returns an array containing keys of somearray
// in_array(something, somearray) returns true if something exists in somearray


$friend_book1 = Array('Humpty' => '111-111-1111', 'Dumpty' => '222-222-2222', 
                      'Duh' => '333-333-3333', 'Oops' => '444-444-4444', 'Huh' => '555-555-5555');
$friend_book2 = Array('Dumpty' => 'dumpty@uva.edu', 'Duh' => 'duh@uva.edu', 
                      'Humpty' => 'humpty@uva.edu', 'Huh' => 'huh@uva.edu', 
                      'Wacky' => 'wacky@uva.edu');

$result = merge_books($friend_book1, $friend_book2);
print($result); 

?>