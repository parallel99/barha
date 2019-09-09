<?php
    function confirm($username, $tokenid){
    /*  $message = '
      <html>
      <body>
        <div style="width: 600px;margin: 0 auto;text-align: center;">
          <h2>Kedves '.$username.'!</h2>
          <strong>
            Valami random szoveg!
          </strong>
            szovag
            <br><a style="color: #fff;background-color: #007bff;border-color: #007bff;display: inline-block;font-weight: 400;color: #212529;text-align: center;vertical-align: middle;user-select: none;background-color: transparent;border: 1px solid transparent;padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 1.5;border-radius: 0.25rem;" href="https://etel-seged.herokuapp.com/activation?id=' . $tokenid . '">Megerősítés!</a>
            <br>megtobbb szoveg
        </div>
        </body>
        </html>
                ';*/

                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" media="all" href="/assets/application-mailer-dbc5154d3c4160e8fa7ef52fa740fa402760c39b5d22c8f6d64ad5999499d263.css" />
   <style><!-- Add custom styles that you want inlined here --></style>
 </head>
 <!-- Edit the code below this line -->
 <body class="bg-light">
<div class="container">
  <img class="mx-auto mt-4 mb-3" width="42" height="30" src="https://s3.amazonaws.com/lyft.zimride.com/images/emails/logo/v2/logo_44@2x.png" />

  <div class="card w-100 mb-4">
    <div class="card-body">
      <img width="50" height="50" class="mx-auto" src="https://s3.amazonaws.com/lyft.zimride.com/images/emails/enterprise/briefcase_dark_large.png">
      <h4 class="text-center">Make expensing business rides easy</h4>
      <p class="text-center">Enable business profile on Lyft to make expensing rides quick and easy.</p>
      <a class="btn btn-primary btn-lg mx-auto mt-2" href="https://lyft.com">Get Business Profile</a>
    </div>
  </div>
</div>

 </body>
</html>';

        return $message;
    }
?>
