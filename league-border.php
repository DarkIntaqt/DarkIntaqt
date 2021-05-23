<?php

$key = 'Your API Key'; // your api key (developer.riotgames.com)
$region = 'region'; //e.g.: euw1

$user = json_decode(file_get_contents('https://'.$region.'.api.riotgames.com/lol/summoner/v4/summoners/by-name/'.$_GET['name'].'?api_key='.$key),true);

$v = json_decode(file_get_contents('https://ddragon.leagueoflegends.com/api/versions.json'),true)[0];

function getBorder($l) {
  if($l >= 500) {
    return 'borders/21.png';
  }
  if($l >= 475) {
    return 'borders/20.png';
  }
  if($l >= 450) {
    return 'borders/19.png';
  }
  if($l >= 425) {
    return 'borders/18.png';
  }
  if($l >= 400) {
    return 'borders/17.png';
  }
  if($l >= 375) {
    return 'borders/16.png';
  }
  if($l >= 350) {
    return 'borders/15.png';
  }
  if($l >= 325) {
    return 'borders/14.png';
  }
  if($l >= 300) {
    return 'borders/13.png';
  }
  if($l >= 275) {
    return 'borders/12.png';
  }
  if($l >= 250) {
    return 'borders/11.png';
  }
  if($l >= 225) {
    return 'borders/10.png';
  }
  if($l >= 200) {
    return 'borders/9.png';
  }
  if($l >= 175) {
    return 'borders/8.png';
  }
  if($l >= 150) {
    return 'borders/7.png';
  }
  if($l >= 125) {
    return 'borders/6.png';
  }
  if($l >= 100) {
    return 'borders/5.png';
  }
  if($l >= 75) {
    return 'borders/4.png';
  }
  if($l >= 50) {
    return 'borders/3.png';
  }
  if($l >= 30) {
    return 'borders/2.png';
  }
  return 'borders/1.png';
}

function createimage($img1,$img2,$level='0') {
  $output = imagecreatetruecolor(1000,1000);

  imagesavealpha($output,true);
  $color = imagecolorallocatealpha($output,0,0,0,127);
  imagefill($output,0,0,$color);

	$first = imagecreatefrompng($img1);
	$second = imagecreatefrompng($img2);

  $f_width = imagesx($first);
  $f_height = imagesy($first);

  $s_width = imagesx($second);
  $s_height = imagesy($second);

  imagecolortransparent($first, imagecolorallocate($first, 255, 0, 255));

  $mask = imagecreatetruecolor($f_width, $f_height);
  $black = imagecolorallocate($mask, 0, 0, 0);
  $magenta = imagecolorallocate($mask, 255, 0, 255);
  imagefill($mask, 0, 0, $magenta);
  $r = min($f_width, $f_height);
  imagefilledellipse($mask, ($f_width / 2), ($f_height / 2), $r, $r, $black);
  imagecolortransparent($mask, $black);
  imagecopymerge($first, $mask, 0, 0, 0, 0, $f_width, $f_height, 100);

  imagedestroy($mask);



  imagecopyresized($output,$first,226,226,0,0, 548, 548,$f_width,$f_height);
	imagecopyresized($output,$second,0,0,0,0, 1000, 1000,$s_width,$s_height);

  $textcolor = imagecolorallocate($output,255,255,255);

  $font = "Roboto-Regular.ttf";
  imagettftext($output,50,0,(500 - (strlen($level) * 20)),824,$textcolor,$font,$level);

  header('Content-type: image/png');

  imagepng($output);

  imagedestroy($output);

  die();

}


createimage('https://ddragon.leagueoflegends.com/cdn/'.$v.'/img/profileicon/'.$user['profileIconId'].'.png',getBorder($user['summonerLevel']),$user['summonerLevel']);


 ?>
