<?php
/* Ad hoc functions to make the examples marginally prettier.*/
/* Mostly copied from the client library base examples. */
function isWebRequest() {
  return isset($_SERVER['HTTP_USER_AGENT']);
}

function pageHeader($title) {
  $ret = "";
  if (isWebRequest()) {
    $ret .= "<!doctype html>
    <html>
    <head>
      <title>" . $title . "</title>
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' integrity='sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ' crossorigin='anonymous'>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js' integrity='sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn' crossorigin='anonymous'></script>
    </head>
    <body><div class='container'> \n";
    $ret .= "<header><h1 class='text-center'>" . $title . "</h1></header>";
  }
  return $ret;
}

function pageFooter() {
  $ret = "";
  if (isWebRequest()) {
    $ret .= "</div></body></html>";
  }
  return $ret;
}

function missingClientSecretsWarning() {
  $ret = "";
  if (isWebRequest()) {
    $ret = "
      <div class='alert alert-danger'>
        Warning: You need to set Client ID, Client Secret and Redirect URI on
        the client_secrets.json file. You can get these from the
        <a href='http://developers.google.com/console'>Google API console</a>
      </div>";
  } else {
    $ret = "Warning: You need to set Client ID, Client Secret and Redirect URI";
    $ret .= " on the client_secrets.json file. You can get these from:\n";
    $ret .= "http://developers.google.com/console";
  }
  return $ret;
}
