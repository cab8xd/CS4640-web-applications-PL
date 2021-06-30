<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/PHPMailer/src/Exception.php';
require '/PHPMailer/src/PHPMailer.php';
require '/PHPMailer/src/SMPT.php'; 


// one logic as to how to solve the presented problem on class activity 

// read JSON data file
// decond JSON format into PHP associative array
// iterate PHP associative array
//      for each record, if it is past ude, send email
//                         else do nothing


// to determine if it's past due
// days_until_now = current_date - checkout_date
// if days_until_now > 14, past due

$borrow_books = get_borrow_records("data/borrow_records.json"); // location of the json file. 
// TODO: adjust path ^ 
// also
//  check PERMISSIONS of file to allow it to be read by other people. 

foreach ($borrow_books['records'] as $record)
{
    // only one key. we do not need to do nested loops in iteration. 
    echo $record['title'] . "," . $records['author'] . "," . 
        $record['email'] . "," . $records['borrow_name'] . "," . 
        $records['email'] . "," . $records[borrower_name] . "," . 
        $record['checkout_date'] . "br/>";
}
// running should print all data in json file. 

// compute based on current day
function compute_days_elapsed($checkout_date)
{
    // need library function from PHP and string subtraction 

    // DateTime object
    $date1 = date_create($checkout_date); // converts string to DateTime-time object. 
    $date2 = date_create(date("ymd")); // retrieves current date in this format. 
    $days_elapsed = date_diff($date1, $date2);
}

function get_borrow_record($filename)
{
    $content = file_get_contents($filename);
    $list_of_books = json_decode($content, true); // change into assoc. array. iif true not incldued we will instead get a general object :(
        return $list_of_books;
}

?>