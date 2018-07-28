<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


function sendMail($postData)
{

    $message = "
        <table style='border-collapse:collapse'>
            <tr rowspan='2'>
                <td>Новая заявка c сайта!</td>
            </tr>
        ";

    foreach ($postData as $key => $val) {
        $message .= "<tr><td>$key</td><td>$val</td></tr>";
    }
    $message .= "</table>";

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.beget.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@cryptot-invest.ru';                 // SMTP username
        $mail->Password = 'FJ7gr*pA';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->CharSet = 'utf-8';
        //Recipients
        $mail->setFrom('info@cryptot-invest.ru', 'NO-reply cryptot-invest.ru');
        $mail->addAddress('zakaz@cryptot-invest.ru');               // Name is optional
        $mail->addReplyTo('info@cryptot-invest.ru', 'Information');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Новая заявка cryptot-invest.ru';
        $mail->Body = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $result = "Спасибо за заявку! <br> В ближайшее время наш сотрудник свяжется с Вами.";
    } catch (Exception $e) {
        $result = 'Я не смог отправить письмо: ' . $mail->ErrorInfo;
    }
    return $result;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = sendMail($_POST);
} else {
    echo 'fuck off';
}


$respond = '
<div class="modal fade" id="ResultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            </button>
            <h5 class="modal-title" id="exampleModalLongTitle">'.$result.'</h5>
        </div>
    </div>
</div>
';
echo $respond;
?>