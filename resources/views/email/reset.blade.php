<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/21/16
 * Time: 11:20 AM
 */
?>
        <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>User Message</h2>


Dear {!! $user['fullname'] !!},<br><br>

We have received your password change request. This email contains the information that you need to change your
password.<br><br>






Please click this link:
 {{--{!! $user['hash'] !!}--}}

<a href="http://localhost/onlineaushadhidac/reset-password.php?resetcode=<?php echo $user['hash']; ?>">reset password</a> to change your password
Feel free to contact us if you require further assistance.<br><br>

Best Regards,<br>
Online Aushadhi Support Team