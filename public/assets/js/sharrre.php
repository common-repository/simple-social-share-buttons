<?php
  header('content-type: application/json');
 
  $json = array('url'=>'','count'=>0);
  $json['url'] = $_GET['url'];
  $url = urlencode($_GET['url']);
  $type = urlencode($_GET['type']);

  if(filter_var($_GET['url'], FILTER_VALIDATE_URL)){
    if($type == 'googlePlus'){  
      $content = parse("https://plusone.google.com/u/0/_/+1/fastbutton?url=".$url."&count=true");

      if (preg_match("/window\.__SSR\s=\s\{c:\s([0-9]+)\.0/", $content, $matches)) {
          $json['count'] = $matches[1];
        }
    }
    else if($type == 'stumbleupon'){
      $content = parse("http://www.stumbleupon.com/services/1.01/badge.getinfo?url=$url");

      $result = json_decode($content);
      if (isset($result->result->views))
      {
          $json['count'] = $result->result->views;
      }

    }
    else if($type == 'pinterest'){
      $content = parse("http://api.pinterest.com/v1/urls/count.json?url=$url");

      $content = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $content);

      $result = json_decode($content);
      if (is_int($result->count))
      {
          $json['count'] = $result->count;
      }
    }
  }
  echo str_replace('\\/','/',json_encode($json));

  function parse($encUrl){
    $options = array(
      CURLOPT_RETURNTRANSFER => true, // return web page
      CURLOPT_HEADER => false, // don't return headers
      CURLOPT_FOLLOWLOCATION => true, // follow redirects
      CURLOPT_ENCODING => "", // handle all encodings
      CURLOPT_USERAGENT => 'sharrre', // who am i
      CURLOPT_AUTOREFERER => true, // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
      CURLOPT_TIMEOUT => 10, // timeout on response
      CURLOPT_MAXREDIRS => 3, // stop after 10 redirects
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => false,
    );
    $ch = curl_init();

    $options[CURLOPT_URL] = $encUrl;
    curl_setopt_array($ch, $options);

    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);

    curl_close($ch);

    if ($errmsg != '' || $err != '') {
      /*print_r($errmsg);
      print_r($errmsg);*/
    }
    return $content;
  }