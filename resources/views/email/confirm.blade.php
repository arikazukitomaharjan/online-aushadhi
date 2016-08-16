<!DOCTYPE html>
 <html lang="en-US">
 <head>
     <meta charset="utf-8">
 </head>
 <body>
 <h2>User Message</h2>
 your detail:





 Thanks for signing up!<br>
 Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
<br>
 ------------------------<br>
 Username: <?php echo $user->fullname?><br>


 ------------------------
<br>

 Please click this link to activate your account:<br>
 <a href="http://www.onlineaushadhi.com/verify.php?email=<?php echo $user->email; ?>&hash=<?php echo $user->hash; ?>">cLick here </a>
{{-- {{ url('api/v1/register/verify/' . $user->hash) }}--}}


 <br/>
 From: 'noreply@onlineaushadhi.com'

</body>
</html>