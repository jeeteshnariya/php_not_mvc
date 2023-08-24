<?php


function load_files($data)
{
  if (is_array($data)) {
    return $data;
  } else {
    return __FILE__ . $data . '.php';
  }
}





function set_url($link)
{
  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]?" . $link;
  return $actual_link;
}

function redirect($link)
{
  header('Location:' . ($link), false);
  // exit;
}

function dd($data = null)
{
  echo '<pre class="bg-gray-100 text-sm border rounded mx-32 p-4 text-red-700">';
  print_r($data);
  // var_export($data);
  echo '</pre>';
}


function get($name)
{
  return isset($_GET[$name]) ? $_GET[$name] : null;
}

function post($name)
{
  return isset($_POST[$name]) ? $_POST[$name] : null;
}


function link_path($link = '') {

  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]/" . $link;
 
 return $actual_link;
}