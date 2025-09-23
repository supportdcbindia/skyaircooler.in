<?php

session_start();

error_reporting(0);



// ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL);



$myfile = fopen("logs.txt", "a+") or die("Unable to open file!");

fwrite($myfile, json_encode($_SERVER));

fwrite($myfile, json_encode($_POST));

function send_request($data)

{

  $curl = curl_init();

  curl_setopt_array($curl, array(

    CURLOPT_URL => 'https://dcbindia.in/akismetcurl/akismet_check.php',

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => '',

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 0,

    CURLOPT_FOLLOWLOCATION => true,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => 'POST',

    CURLOPT_POSTFIELDS => $data,

  ));

  $response = json_decode(curl_exec($curl));

  curl_close($curl);

  return $response;

}



$name = htmlspecialchars(stripslashes(trim($_POST['name'])));

$company_name = htmlspecialchars(stripslashes(trim($_POST['company_name'])));

$email = htmlspecialchars(stripslashes(trim($_POST['email'])));

$message = $_POST['message'];

$city = htmlspecialchars(stripslashes(trim($_POST['city'])));

$phone = htmlspecialchars(stripslashes(trim($_POST['number'])));

$country = htmlspecialchars(stripslashes(trim($_POST['country'])));

$code = htmlspecialchars(stripslashes(trim($_POST['code'])));



$allowed_origins = array('https://www.skyaircooler.in/', 'https://www.skyaircooler.in/', 'http://skyaircooler.in/', 'http://www.skyaircooler.in/', 'https://skyaircooler.in', 'https://www.skyaircooler.in', 'http://skyaircooler.in', 'http://www.skyaircooler.in');

if (!in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {

  header('location:https://www.skyaircooler.in/contact.php');

}



$curlArr = array_merge($_POST, $_SERVER);

$curlArr['sitename'] = $_SERVER['HTTP_HOST'];

$curlArr['save'] = false;

$response = send_request($curlArr);

if ($response->result) {

  $curlArr = array_merge($_POST, $_SERVER);

  $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

  $curlArr['save'] = true;

  $curlArr['bcoz'] = "API CONDITION FAIL";

  $curlArr['status'] = "FAIL";

  $response = send_request($curlArr);

  header('location:https://www.skyaircooler.in/contact.php');

} else {

  if (isset($name) && trim($name) !== '' && isset($email) && trim($email) !== '' && isset($message) && trim($message) !== '' && isset($phone) && trim($phone) !== '' && isset($city) && trim($city) !== '' && isset($country) && trim($country) !== '' && isset($company_name) && trim($company_name) !== '') {

    if ($_SESSION["code"] == $_POST['captcha'] && $_POST['captcha'] != "!UNKNOWN_TYPE!" && $_POST['captcha'] != "" && $_SESSION["code"] != "") {

      if (!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email)) {

        //echo "ERROR junk email detact";

        $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

        $curlArr['save'] = true;

        $curlArr['bcoz'] = "JUNK DETACT";

        $curlArr['status'] = "FAIL";

        $response = send_request($curlArr);

        header('location:https://www.skyaircooler.in/contact.php');

      } else {

        $matches_words = array();

        $city_words = array();

        $junk_word = '#\b(Moscow|Hey|Body|Revolution|Medico|Postura|Posture|Corrector|50%|OFF|FREE|Worldwide|Shipping|Shipping|medicopostura|online|Thank|CAREDOGBEST|Website|Re-designing|SEO|optimization|promotion|marketing|Marketing|Search|Engine|Optimization|advertisements|advertisement|advertising|adversement|Advertisement|graphic|design|traffic|advertisers|advertise|Advertising|campaigns|Domain|Domains|cheap|dollar|poker|Websites|redesigning|WordPress|newspapers|Eric|sunglasses|Girls|masturbating|porn|Nude|Sex|Naked|Women|website|fantastic|sorry|Google|doc|ADELIAPUTRI|blog|Petr|Velkov|https|http)\b#';

        preg_match_all($junk_word, $message, $matches_words);

        preg_match_all($junk_word, $city, $city_words);

        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $message, $msg_match);

        preg_match_all('/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i', $message, $msg_match_email);





        if (count($msg_match[0]) > 0 || count($msg_match_email[0]) > 0 || count($matches_words[0]) > 0 || count($city_words[0]) > 0) {

          //echo "ERROR junk msg";

          $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

          $curlArr['save'] = true;

          $curlArr['bcoz'] = "JUNK DETACT";

          $curlArr['status'] = "FAIL";

          $response = send_request($curlArr);

          header('location:https://www.skyaircooler.in/contact.php');

        } else {

          require_once('phpmailer/class.phpmailer.php');

          $message_body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

                                    <html>

                                      <head>

                                      <meta http-equiv="content-type" content="text/html; charset=windows-1250">

                                      <meta name="generator" content="PSPad editor, www.pspad.com">

                                      <title></title>

                                      <style type="text/css">span.go{display:none} .go{display:none}</style>

                                      </head>

                                      <body>

                                        <div style="font-family:arial;font-size:12px;font-weight:normal;color:#000000;background:#ffffff;border:10px solid #cccccc;width:600px;padding:20px;margin: 0px auto;">

                                        <table border="1" cellpadding="5" style="width:500px;font-family:arial;font-size:12px;font-weight:normal;color:#000000;border-collapse:collapse;border:1px solid #cccccc;border-color:#cccccc">

                                          <tbody>

                                            <tr>

                                              <td colspan="2" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000;border-bottom:3px solid #cccccc"><b>Enquiry Details</b></td>

                                            </tr>

                                            

                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">Name:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000"><b>' . $name . '</b></td>

                                            </tr>



                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">Company Name:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000"><b>' . $company_name . '</b></td>

                                            </tr>

                                           

                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">Email:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000"><b>' . $email . '</b></td>

                                            </tr>



                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">Country:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000"><b>' . $country . '</b></td>

                                            </tr>

                                           

                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">City:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000"><b>' . $city . '</b></td>

                                            </tr>



                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">Mobile:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000"><b>' . $code . '-' . $phone . '</b></td>

                                            </tr>

                                            

                                            <tr>

                                              <td align="right" style="font-family:arial;font-size:12px;font-weight:normal;color:#000000">Message:</td>

                                              <td style="font-family:arial;font-size:12px;font-weight:normal;color:#000000;line-height:17px"><b>' . $message . '</b></td>

                                            </tr>

                                            <tr>

                                            </tr>

                                          </tbody>

                                        </table>

                                      </div>

                                      </body>

                                    </html>

                                    ';

          $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

          $mail->IsSMTP(); // telling the class to use SMTP

          try {

            $mail->Host = "mail.smtp2go.com"; // SMTP server

            $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)

            $mail->AddAddress('marketing@skyaircooler.com', 'New Enquiry From Sky Air Cooler Corporate Website');
            $mail->AddAddress('marketing@skyaircooler.in', 'New Enquiry From Sky Air Cooler Corporate Website');

            $mail->SetFrom('marketing@skyaircooler.in', 'New Enquiry From Sky Air Cooler Corporate Website');

            $mail->AddBCC('dcbrainsinquiry@gmail.com', 'New Enquiry From Sky Air Cooler Corporate Website');



            $mail->Port = 443;

            $mail->Subject = 'New Enquiry From Sky Air Cooler Corporate Website';

            $mail->SMTPAuth = true;

            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail

            $mail->Username = "skyaircooler";

            $mail->Password = "f5FrW4NyTCM61EwW";

            $mail->MsgHTML($message_body);

            //$mail->AddAttachment('images/phpmailer.gif');      // attachment

            // $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment

            $mail->Send();

            $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

            $curlArr['save'] = true;

            $curlArr['bcoz'] = "MAIL SEND SUCCUSS";

            $curlArr['status'] = "SUCCESS";

            $response = send_request($curlArr);

            header('location:https://www.skyaircooler.in/thankyou.php');

            //echo "Message Sent OK<p></p>\n";

          } catch (phpmailerException $e) {

            $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

            $curlArr['save'] = true;

            $curlArr['bcoz'] = "MAIL SETTING NOT WORKING";

            $curlArr['Exception'] = $e->errorMessage();

            $curlArr['status'] = "FAIL";

            $response = send_request($curlArr);

            echo $e->errorMessage(); //Pretty error messages from PHPMailer



          } catch (Exception $e) {

            $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

            $curlArr['save'] = true;

            $curlArr['bcoz'] = "MAIL SETTING NOT WORKING";

            $curlArr['Exception'] = $e->getMessage();

            $curlArr['status'] = "FAIL";

            $response = send_request($curlArr);

            echo $e->getMessage(); //Boring error messages from anything else!



          }

        }

      }

    } else {

      $curlArr = array_merge($_POST, $_SERVER);

      $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

      $curlArr['save'] = true;

      $curlArr['bcoz'] = "CAPTCHA MISMATCH";

      $curlArr['status'] = "FAIL";

      $response = send_request($curlArr);

?>

      <script>

        if (confirm("You have enter Wrong Captcha.....Please Enter Correct Captcha Code")) {

          window.location.href = "https://www.skyaircooler.in/contact.php";

        } else {

          window.location.href = "https://www.skyaircooler.in/contact.php";

        }

      </script>

    <?php

    }

  } else {

    $curlArr = array_merge($_POST, $_SERVER);

    $curlArr['sitename'] = $_SERVER['HTTP_HOST'];

    $curlArr['save'] = true;

    $curlArr['bcoz'] = "REQUIRED DETAIL MISSING";

    $curlArr['status'] = "FAIL";

    $response = send_request($curlArr);



    ?>

    <script>

      if (confirm("Please Enter All Details Correct..")) {

        window.location.href = "https://www.skyaircooler.in/contact.php";

      } else {

        window.location.href = "https://www.skyaircooler.in/contact.php";

      }

    </script>



<?php

  }

}

?>