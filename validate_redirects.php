<?php
$file = file_get_contents('example.csv');
$lines = explode("\n", $file);

function redirects_to ($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_NOBODY, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

  $response = curl_exec($ch);

  # Follow all redirects, get the final URL that got called
  $result = curl_getinfo($ch);
  return $result['url'];
}

foreach ($lines as $line) {
  if (stristr($line, 'http') !== false) {
    # This line contains an URL, validate it
    $pieces = explode(";", $line);
    $from = trim($pieces[0]);
    $to = trim($pieces[1]);

    # Normalise URL: if the "to" has no trailing slash, add it
    if (substr($to, strlen($to)-1, 1) != "/") {
      $to .= "/";
    }

    $redirect_to = redirects_to($from);

    $redirect_correct = false;
    if ($redirect_to == true && $to == $redirect_to) {
      # There was a redirect, was it correct?
      $redirect_correct = true;
    }

    if ($redirect_correct == true) {
      echo "[Y] ". $from ." -> ". $to ."\n";
    } else {
      echo "[X] ". $from ." -> ". $to ." (redirected to ". $redirect_to .")\n";
    }
  }
}

?>
