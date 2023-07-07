<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include_once 'helpers/helper.php';
require 'helpers/init_conn_db.php';
include_once('tcpdf/tcpdf.php');

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('FLYBOOKR.com');
        $pdf->SetAuthor('ADMIN');
        $pdf->SetTitle('E - Ticket');
        $pdf->SetSubject('Your Ticket has been generated Successfully');
        $pdf->SetKeywords('HTML, PDF, TCPDF');
        $pdf->SetMargins(15, 15, 15);
        $pdf->AddPage();
        $pdf->SetFont('times', '', 12);
if(isset($_SESSION['userId'])) {
    $stmt = mysqli_stmt_init($conn);
    $sql = 'SELECT * FROM Ticket WHERE user_id=?';
    $stmt = mysqli_stmt_init($conn);
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i',  $_SESSION['userId']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $sql_p = 'SELECT * FROM Passenger_profile WHERE passenger_id=?';
        $stmt_p = mysqli_stmt_init($conn);
        $stmt_p = mysqli_prepare($conn, $sql_p);
        mysqli_stmt_bind_param($stmt_p, 'i', $row['passenger_id']);
        mysqli_stmt_execute($stmt_p);
        $result_p = mysqli_stmt_get_result($stmt_p);
        if ($row_p = mysqli_fetch_assoc($result_p)) {
            $sql_f = 'SELECT * FROM Flight WHERE flight_id=?';
            $stmt_f = mysqli_stmt_init($conn);
            $stmt_f = mysqli_prepare($conn, $sql_f);
            mysqli_stmt_bind_param($stmt_f, 'i', $row['flight_id']);
            mysqli_stmt_execute($stmt_f);
            $result_f = mysqli_stmt_get_result($stmt_f);
            if ($row_f = mysqli_fetch_assoc($result_f)) {
                $date_time_dep = $row_f['departure'];
                $date_dep = substr($date_time_dep, 0, 10);
                $time_dep = substr($date_time_dep, 10, 6);
                $date_time_arr = $row_f['arrival'];
                $date_arr = substr($date_time_arr, 0, 10);
                $time_arr = substr($date_time_arr, 10, 6);
                if ($row['class'] === 'E') {
                    $class_txt = 'Economy';
                } elseif ($row['class'] === 'B') {
                    $class_txt = 'Business';
                }
            }
            $content = '';
        $content .= '
        <h1>Your E-Ticket!</h1>
        <div style="border-radius:10px;border: 1px solid black; width: 70%;margin-left: 250px;font-family:Poppins,sans-serif;">
        <div style="text-align: center;">
           <h2>
            <img src="assets/images/logo.png" style="position: relative;top: 20px;" height="50px" width="50px" alt="">FLYBOOKR.com</h2>  
        </div>
        <table   width="100%" style=" table-layout: fixed;margin-top: 40px; align-items: center;  border-collapse: collapse;">
            <tr>
                <th style=" font-weight:bold;border: 1px solid #dddddd;text-align: left;padding: 8px;">Airline</th>
                <th style=" font-weight:bold;border: 1px solid #dddddd;text-align: left;padding: 8px;">From</th>
                <th style=" font-weight:bold;border: 1px solid #dddddd;text-align: left;padding: 8px;">To</th>
            </tr>
            <tr>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">'.$row_f['airline'].'</td>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">'.$row_f['source'].'</td>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">'.$row_f['Destination'].'</td>
            </tr>
        </table>
        <table   width="100%" style="table-layout: fixed; margin-top: 40px; align-items: center;  border-collapse: collapse;">
            <tr>
                <th style="font-weight:bold; border: 1px solid #dddddd;text-align: left;padding: 8px;">Passenger</th>
                <th style="font-weight:bold; border: 1px solid #dddddd;text-align: left;padding: 8px;">Gate</th>
                <th style="font-weight:bold; border: 1px solid #dddddd;text-align: left;padding: 8px;">Seat</th>
            </tr>
            <tr>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">'.$row_p['f_name'] . '' . $row_p['l_name'].'</td>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">A22</td>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">'.$row['seat_no'].'</td>
            </tr>
        </table>
        <table   width="100%" style="margin-bottom:50px;table-layout: fixed; margin-top: 40px; align-items: center;  border-collapse: collapse;">
            <tr>
                <th style=" font-weight:bold;border: 1px solid #dddddd;text-align: left;padding: 8px;">Departure</th>
                <th style=" font-weight:bold;border: 1px solid #dddddd;text-align: left;padding: 8px;">Arrival</th>
                <th style=" font-weight:bold;border: 1px solid #dddddd;text-align: left;padding: 8px;">Class</th>
            </tr>
            <tr>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">' . $date_dep .'  '. $time_dep . '</td>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">' . $date_arr . '  ' . $time_arr . '</td>
                <td style=" border: 1px solid #dddddd;text-align: left;padding: 8px;background-color: #f1eeee;">' . $class_txt . '</td>
            </tr>
        </table>
        <p style="text-align: center;">Thank you for Reaching us!</p>
    </div>
    </body>
    ';
        }
        
        
        
    }
    $pdf->writeHTML($content);
        // ob_end_clean();
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="output.pdf"');
        // $pdf->Output('E-Ticket.pdf', 'D');
        // exit();
        $file_location = "/wamp64/www/flybookr/uploads/";
        $datetime=date('dmY_hms');
        $file_name = "TICKET_".$datetime.".pdf";
        $pdf->Output($file_location.$file_name, 'F');
        require('PHPMailer\PHPMailer-master\src\PHPMailer.php');
        require('PHPMailer\PHPMailer-master\src\Exception.php');
        require('PHPMailer\PHPMailer-master\src\SMTP.php');
        $body='';
	$body .="<html>
	<head>
	<style type='text/css'> 
	body {
	font-family: Calibri;
	font-size:16px;
	color:#000;
	}
	</style>
	</head>
	<body>
	Dear Customer,
	<br>
	Please find attached E-Ticket .
	<br>
	Thank you!
	</body>
	</html>";
    $email = 'flybookr@gmail.com';
    $email2 = $_SESSION['userMail'];
    $mail = new PHPMailer(true);
    $alert = '';

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'flybookr@gmail.com'; // SMTP username of sender....customer
    $mail->Password = 'nvinjlaeznpmzxmh'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
    $mail->setFrom($email);
    $mail->addAddress($email2);
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject    = "Invoice details";
    $mail->Body = $body;
    $mail->AddAttachment($file_location.$file_name);
    $mail->WordWrap = 50;
    $mail->send();
    $mail->SmtpClose();
	if($mail->IsError()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
        header("Location:./index.php");					
	};
}
else{
    echo'Record not found';
}
?>