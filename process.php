<?php
include 'connectionfile.php';
if(isset($_POST['submit']))
{
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $emailaddress=$_POST['emailaddress'];
    $phonenumber=$_POST['phonenumber'];
    $subject=$_POST['subject'];
    $yourmessage=$_POST['yourmessage'];
}