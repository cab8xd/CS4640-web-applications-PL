<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/PHPMailer/src/Exception.php';
require '/PHPMailer/src/PHPMailer.php';
require '/PHPMailer/src/SMPT.php'; 
// adjust base on path

$mail = new PHPMailer(true);

// good practice
try {
    // in notes?
    $msg = "TODO: look at mail-handler-solution..."
    // Server settings

    // set SMPT as mailing protocol
    // see 
}
catch (Exception $e) {
    $msg = "Sorry, your comment or suggestion..."
}

?>