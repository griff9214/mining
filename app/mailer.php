<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
require_once __DIR__ . '/recaptcha/autoload.php';

$siteKey = '6Lclt0AUAAAAAD3R3YC3mvaRD8SOssmU26OYbYuL';
$secret = '6Lclt0AUAAAAAKtsM96iGBUQFk_obzdeaC0MEUZS';
$lang = 'ru';
function sendMail($postData)
{

    $message = "
        <table style='border-collapse:collapse'>
            <tr rowspan='2'>
                <td>Новая заявка на консультацию!</td>
            </tr>
        ";

    foreach ($postData as $key => $val) {
        if ($key != 'g-recaptcha-response') $message .= "<tr><td>$key</td><td>$val</td></tr>";
    }
    $message .= "</table>";

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'no-reply@forpost-sever.ru';                 // SMTP username
        $mail->Password = '%kkhNa8H7JIi';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->CharSet = 'utf-8';
        //Recipients
        $mail->setFrom('no-reply@forpost-sever.ru', 'Forpost Mailer');
        $mail->addAddress('griff@list.ru');               // Name is optional
        $mail->addReplyTo('no-reply@forpost-sever.ru', 'Information');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Новая заявка FORPOST';
        $mail->Body = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $result = "Спасибо за заявку! <br> В ближайшее время наш сотрудник свяжется с Вами.";
    } catch (Exception $e) {
        $result = 'Я не смог отправить письмо: ' . $mail->ErrorInfo;
    }
    return $result;

}

if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {
        $result = sendMail($_POST);
    } else {
        $result = "Что-то с каптчей! Если вы не робот, то попробуйте связаться с нами по телефону.";
    }
} elseif (isset($_POST['aside-form']) || isset($_POST['footer-form']) || isset($_POST['only-phone'])) {
    $result = sendMail($_POST);
} else {
    echo 'fuck off';
}


$respond = '
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            </button>
            <h5 class="modal-title" id="exampleModalLongTitle">Спасибо за заявку!</h5>
        </div>
    </div>
</div>
';
echo $respond;
?>