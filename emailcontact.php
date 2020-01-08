<?php

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $emailFrom = $_POST['email'];
  $phone = $_POST['phone'];
  $query = $_POST['query'];

  $emailTo = "d10811147@urhen.com";
  $headers = "From: ".$emailFrom;
  $txt = "You have received an email from ".$name.".\n\n".$query;

  mail($emailTO, $subject, $txt, $headers);
  header("Location: contact.html?mailsend");
}
