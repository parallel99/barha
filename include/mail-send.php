<?php
class Mail {

  public $name;
  public $emailaddress;
  public $title;
  public $message;

  public function __construct($name, $emailaddress, $title, $message) {
      $this->name = $name;
      $this->emailaddress = $emailaddress;
      $this->title = $title;
      $this->message = $message;
  }

  public function Send() {
      require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
      $email = new \SendGrid\Mail\Mail();
      $email->setFrom("etel@seged.com", "étel-segéd");
      $email->setSubject($this->title);
      $email->addTo($this->emailaddress, $this->name);
      //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
      $email->addContent("text/html", $this->message);

      $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
      try {
          $response = $sendgrid->send($email);
          //print $response->statusCode() . "\n";
          //print_r($response->headers());
          //print $response->body() . "\n";
      } catch (Exception $e) {
          echo 'Caught exception: '. $e->getMessage() ."\n";
      }
  }
}
