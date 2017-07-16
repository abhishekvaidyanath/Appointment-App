<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$Date = $_POST['Date'];
$Time = $_POST['Time'];
$Message = $_POST['Message'];

//Validate first
if(empty($Name)||empty($Email)||empty($Phone)||empty($Date)||empty($Time)||empty($Message)) 
{
    echo "All fields are mandatory. Kindly fill all the details.";
    exit;
}

if(IsInjected($Email))
{
    echo "Enter proper mail ID";
    exit;
}

$email_from = "info@itcoordinates.com";//<== update the email address
$email_subject = "Appointment Enquiry from App";
$email_body = "You have received a new Appointment Enquiry for meeting\n".
    "\n Name: $Name \n".
	"\n Email: $Email \n".
	"\n Phone:\n $Phone \n".
	"\n Date:\n $Date \n".
	"\n Time:\n $Time \n".
	"\n Reason for Appointment:\n $Message \n".
    
$to = "syed_zafarullah@hotmail.com, abhishekvaidyanath@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $Email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 