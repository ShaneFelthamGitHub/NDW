<?php
if (isset($_POST["submit"])) {

	$to = "shane.feltham@gmail.com";
	$from = $_REQUEST['email'];
	$name = $_REQUEST['name'];
	$phone = $_REQUEST['phone'];
	$subject = $_REQUEST['subject'];
	$number = $_REQUEST['number'];
	$cmessage = $_REQUEST['message'];

	$headers = "From: $from";
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: " . $from . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$subject = "New enquiry from National Drains and Water Website.";

	$body = "<!DOCTYPE html>";
	$body = "<html lang='en'>";
	$body .= "<head><meta charset='UTF-8'>";
	$body .= "<title>National Drains and Water</title></head>";
	$body .= "<body>";
	$body .= "<table style='width: 100%;'>";
	$body .= "<thead style='text-align: center;'>";
	$body .= "<tr>";
	$body .= "<td style='border:none;' colspan='2'>";
	$body .= "</td>";
	$body .= "</tr>";
	$body .= "</thead>";
	$body .= "<tbody>";
	$body .= "<tr>";
	$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
	$body .= "</tr>";
	$body .= "<tr>";
	$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
	$body .= "</tr>";
	$body .= "<tr>";
	$body .= "<td style='border:none;'><strong>Phone:</strong> {$phone}</td>";
	$body .= "</tr>";
	$body .= "<tr>";
	$body .= "<td style='border:none;'><strong>Message:</strong><br/>{$cmessage}</td>";
	$body .= "</tr>";
	$body .= "</tbody>";
	$body .= "</table>";
	$body .= "</body>";
	$body .= "</html>";

	// Check if name has been entered
	if (!$name == "") {
		$errName = 'Please enter your name';
	}

	// Check if phone has been entered
	if (!$phone) {
		$errPhone = 'Please enter your phone number';
	}

	// Check if email has been entered and is valid
	if (!$from || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
	}

	//Check if message has been entered
	if (!$message) {
		$errMessage = 'Please enter your message';
	}

	if (!$errName && !$errPhone && !$errEmail && !$errMessage) {

		if (mail($to, $subject, $body, $from)) {
			$result = '<div class="alert alert-success">Thank You! We will be in touch</div>';
		} else {
			$result = '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later or call us on 0800 078 9661.</div>';
		}
		// $send = mail($to, $subject, $body, $headers);
	}
}
