<?php
    function confirm($username, $tokenid){
      $message = '
      <style>
          @import url(\'https://fonts.googleapis.com/css?family=Kalam&display=swap\');
          * {
              font-family: \'Kalam\', cursive;
          }
      </style>
      <html>
      <body>
        <div style="width: 600px;margin: 0 auto;text-align: center;">
          <h2>Kedves '.$username.'!</h2>
          <strong>
            Valami random szoveg!
          </strong>
            szovag
            <button style="color: #fff;background-color: #007bff;border-color: #007bff;display: inline-block;font-weight: 400;color: #212529;text-align: center;vertical-align: middle;user-select: none;background-color: transparent;border: 1px solid transparent;padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 1.5;border-radius: 0.25rem;" href="https://etel-seged.herokuapp.com/activation?id=' . $tokenid . '">Megerősítés!</button>
            megtobbb szoveg
        </div>
        </body>
        </html>
                ';

        return $message;
    }
?>
