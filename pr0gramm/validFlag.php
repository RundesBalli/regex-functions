<?php
/**
 * Function to validate flags from pr0gramm.com
 * @see https://github.com/RundesBalli/regex-functions/blob/master/pr0gramm/validFlag.php
 * 
 * @param int The flag to be checked.
 * 
 * @return string/boolean On success the validated flag will be returned, if not FALSE.
 */
function validFlag($flag) {
  $regex = '/^([1-9]|1[0-5])$/';
  return (preg_match($regex, trim($flag), $matches) === 1) ? $matches[0] : FALSE;
}
?>
