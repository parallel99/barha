<meta name="author" content=""/>
<meta name="description" content="">
<meta name="keywords" content="">

<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/css/main.css"/>



<!-- Open Graph -->
<meta property="og:title" content=""/>
<meta property="og:description" content=""/>
<meta property="og:image" content="/images/og.png"/>
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:type" content="website"/>

<meta name="referrer" content="origin">

<link href="https://fonts.googleapis.com/css?family=Kalam:400,700&display=swap" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<!-- jqueryui -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $( function() {
    var ingredients = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $("#ingredients").autocomplete({
      source: ingredients
    });
    var i;
    for (i = 0; i <= $(".ingredients-group > div").length; i++) {
        $("#ingredients" + i).autocomplete({
          source: ingredients
        });
    }
  } );
  </script>

<?php
date_default_timezone_set("Europe/Budapest");
?>
