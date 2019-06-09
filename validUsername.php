<?php
/**
 * Function to validate usernames from pr0gramm.com
 * @see https://github.com/RundesBalli/regex-functions/blob/master/validUsername.php
 * 
 * @param string The username to be checked.
 * 
 * @return string/boolean On success the validated username will be returned, if not FALSE.
 */
function validUsername($username) {
  $regex = '/^[a-zA-Z0-9-_]{2,32}$/i';
  return (preg_match($regex, trim($username), $matches) === 1) ? $matches[0] : FALSE;
}
?>
