<?php 
// sample solution for PHP mail service (Library notification)

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '/Applications/XAMPP/htdocs/cs-resources/PHPMailer/src/Exception.php';
// require '/Applications/XAMPP/htdocs/cs-resources/PHPMailer/src/PHPMailer.php';
// require '/Applications/XAMPP/htdocs/cs-resources/PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$borrow_records = get_borrow_records("data/borrow_records.json");

foreach ($borrow_records['records'] as $record)
{
   echo $record['title'] . "=>" . $record['authors'] . "," .
        $record['email'] . "," . $record['borrower_name'] . "," . 
        $record['checkout_date'] . " <br/>";
   
   $days_elapsed = compute_days_elapsed($record['checkout_date']);   
   if ($days_elapsed > 14)
   {
      echo "notify overdue -- send email <br/>";

      $checkout_date = date_create($record['checkout_date']);      
      $date_interval = new DateInterval('P14D');    // create 14 days interval; P for period; D for days 

      $due_date = date_add($checkout_date, $date_interval);
      try { 
         send_email($record['borrower_name'], $record['email'], $record['title'], $due_date);
      } catch (Exception $e) {
      	 echo "Unable to send mail <br/>";
      }      
   }
   else 
      echo "not due yet <br/>";
}



?>

<?php
// Make it a function so that if there are multiple files, no repeated code to read file
function get_borrow_records($filename)
{
   // Read JSON data from data/borrow_records.json
   $content = file_get_contents($filename);
	
   // For each record, determine if the book is overdue.
   // If it is overdue, construct an email notification; else, do nothing.
	
   // convert JSON string read from file into PHP associative array
   $list_of_books = json_decode($content, true);
   return $list_of_books;			
}

function compute_days_elapsed($checkout_date)
{
	$date1 = date_create($checkout_date);
	
	date_default_timezone_set('America/New_York');
	
	$date2 = date_create(date("ymd"));
	// date(format) returns current date with a specified format
	// l (lowercase 'L') - a full textual representation of a day
	
	echo $date1->format("y m d") . " : " . $date2->format("y m d") . "<br/>";
		
	$days_elapsed = date_diff($date1, $date2);
	return $days_elapsed->format("%r%a");	
	// %r -- sign "-" when negativew, empty when positive
	// %a -- total number of days	
}
?>

<?php
function send_email($send_to_name, $send_to_email, $book_title, $due_date)
{	
   $confirm = null;

   // initialize PHP Mailer
   $mail = new PHPMailer(true);                        // Passing `true` enables exceptions
   try {
      //Server settings

      // set SMTP as mailing protocol
      $mail->isSMTP();                                 // Set mailer to use SMTP
      $mail->Mailer = "smtp";

      // set required parameters for making an SMTP connection
      $mail->SMTPAuth = TRUE;                          // Enable SMTP authentication
      $mail->SMTPSecure = "tls";                       // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                               // TCP port to connect to
      $mail->Host = "smtp.gmail.com";                  // Specify main and backup SMTP servers
      $mail->Username = "your-username@gmail.com";     // SMTP username 
      $mail->Password = "your-password";               // SMTP password 

      //Recipients
      $mail->setFrom('your-username@gmail.com', 'webPL Library');      // email address and name (name is optional)  
      $mail->addAddress($send_to_email);               
      
      $mail->isHTML(true);                             // Set email format to HTML
      $mail->Subject = 'webPL Library: Overdue notification';
      $mail->Body    = 'Hi ' . $send_to_name . ', The book entitled ' . $book_title . 
                       ' was due on ' . $due_date->format("d-M-Y") . '. ';    

      if ($mail->send())        // return true on success, false on error
         echo "Sending notification successfully <br/>";
      else
         echo "Failed <br/>";
      
   } catch (Exception $e) {
   echo 'Sorry, your comment or suggestion could not be sent. Please contact <a href="mailto:your-username@gmail.com?Subject=Contact us">admin</a>';
   }
}
?>

