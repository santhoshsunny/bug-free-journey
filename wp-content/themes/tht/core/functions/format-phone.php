<?php

abstract class PhoneFormats {
  const LIST = array(
      'usa'  => [
        0 => "$1-$2",
        1 => "$1-$2-$3",
        2 => "$1-$2-$3-$4",
      ],
  );
}

/** 
 * Returns a formatted phone number.
 * @param string $country country. Will determine the type of output. Available: [us, us2]
 * @param string $phone  The original phone number
 * @return string 
 */ 
function format_phone($format, $phone) {
  if(isset(PhoneFormats::LIST[$format])) {
      $formats = PhoneFormats::LIST[$format];
      if(!isset($phone{3})) { return ''; }
        // note: strip out everything but numbers 
      $phone  = preg_replace("/[^0-9]/", "", $phone);
      $length = strlen($phone);
      switch($length) {
        case 7:
          return preg_replace("/([0-9]{3})([0-9]{4})/", $formats[0], $phone);
        break;
        case 10:
          return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", $formats[1], $phone);
        break;
        case 11:
          return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", $formats[2], $phone);
        break;
        default:
          return $phone;
        break;
      }
  }
  return $phone;
}

add_filter( 'format_phonenumber', 'format_phone', 10, 2 );