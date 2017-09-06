<?php
if(isset($_POST['eMail'])) {
	
	// Here is the email to information
	$email_to = "your email address goes here";
	$email_subject = "Computer Assistance";
	$email_from = "See UDC IT Help Page";
	
	// Error code
	function died($error) {
		echo "We're sorry, but there were error(s) found with the form.";
		echo "The following information was not submitted:<br/><br/>";
		echo $error. "<br/><br/>";
		echo "Please fill in the information required.<br/>";
		die();
		}
	
	// Validation
	if (!isset($_POST['name'])) ||
	!isset($_POST['eMail']) ||
	!isset($_POST['issue']) {
		died('We are sorry, but there were error(s) found with the form.');
		}
	
	// Variables
	$name = $_POST['name'];
	$email = $_POST['eMail'];
	$comments = $_POST['issue'];
	
	// Setting Parameters
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-] +@[A-Za-z0-9.-]+\.[A-Za-z][2,4]$/';
	if(!preg_match($email_exp, $email)) {
		$error_message .= 'The E-Mail address entered does not appear to be valid.<br/>';
		}
	
	$string_exp = "/^[A-Za-z.'-]+$/";
	if (!preg_match($string_name, $name)) {
		$error_message .= 'The name entered does not appear to be valid.<br/>';
		}
	
	if(strlen($comments) < 2) {
		$error_message .= 'The sentence entered does not appear to be valid.<br/>';
		}
	
	if(strlen($error_message) > 0) {
		died($error_message);
		}
		$email_message = "Form Details Below.\n\n";
		
	// Sanitizing Web Form
	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad, "", $string);
		}
	$email_message .="Name:" . clean_string($name) . "\n";
	$email_message .="E-Mail:" . clean_string($email) . "\n";
	$email_message .="Issue:" . clean_string($comments) . "\n";
	
	// Create E-Mail headers
	$headers = 'From: ' .$email_From . "\r\n". 'Reply To:' .$email. "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);
?>
<!-- success message-->
Thank you for contacting us. We will be in touch as soon as possible. <br/>
Please click <a href="TestPage2.html">here</a> to go back to the form.
<?php
}
?>