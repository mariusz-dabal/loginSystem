<?php
require_once "db.php";
require_once "user.inc.php";
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


session_start();

if (isset($_POST['register_submit'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $_SESSION['first_name'] = $firstName;
    $_SESSION['last_name'] = $lastName;
    $_SESSION['email'] = $email;

    $user = new User($firstName, $lastName, $email, $password, $password2);

    $user->createUser($pdo);
    
    if (!empty($user->getErrors())) {
        $errors = $user->getErrors();
        $_SESSION['e_form'] = $errors; 
       
        header("Location: ../register.php");
        exit(); 
    } else {
        header("Location: ../index.php?register=true");
        try {
        $mail = new PHPMailer(true);                              
       
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "jimmystestpage@gmail.com";
            $mail->Password = "hmhbqksjingznnel";                                           
            $mail->setFrom('jimmystestpage@gmail.com', 'Jimmy');

            $mail->addAddress($email, "{$firstName} {$lastName}"); 
            
            $body = "<b>Aby dokończyć rejestrację kliknij poniższy link:</b></br>
            http://localhost/loginsystem/activate.php?hash=".$user->getActivationKey();
        
            $mail->isHTML(true);                                  
            $mail->Subject = 'Authentication Email';
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }

} else {
    header("Location: ../index.php");
     exit();
}