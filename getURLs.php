<?php
/**
 * Function to extract URLs from a text. Additionally it is checked if the URL is valid (Check DNS if there is an A-Record)
 * @see https://github.com/RundesBalli/regex-functions/blob/master/getURLs.php
 * 
 * @param string The text.
 * 
 * @return array/NULL An array is returned if valid URLs are in the text, if not NULL is returned.
 */
function getURLs($text) {
  $regex = '/(^|\s)((https?:\/\/)?(\.?[\w-]+)*(\.[a-z-]{2,})(\.[a-z-]{2,})?(\/\S*)?)/i';
  preg_match_all($regex, $text, $matches);
  $urls = array();
  foreach($matches[0] as $key => $value) {
    $url = trim($value);
    $dnsurl = parse_url($url, PHP_URL_HOST);
    if(!empty($dnsurl)) {
      if(checkdnsrr($dnsurl, "A")) {
        $urls[] = $url;
      }
    }
  }
  if(empty($urls)) {
    return NULL;
  } else {
    return $urls;
  }
}
?>
