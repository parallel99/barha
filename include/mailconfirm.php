<?php
    function confirm($username, $tokenid){
      ?>
        <html lang='hu'>
          <head>
          </head>
          <dody>
          <h2>Kedves <?php echo $username;?>!</h2>
          <strong>
            Mivel regisztráltál nálunk, ezért automatán generáltunk neked egy megerősítő email-t!
          </strong>
            Az alábbi linken tudod megerősíteni a regisztrációdat: <a href=<?php echo $tokenid;?>>Kattintson ide!</a>
            Ha nem te regisztráltál akkor hagyd figyelmen kívül ezt az email-t!(Máté ezt még fejleszteni kell)
          </body>
        </html>
<?php
    }
?>
