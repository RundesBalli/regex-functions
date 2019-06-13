<?php
/**
 * Function to get the pr0gramm post- and comment-id from an URL
 * 
 * This regex was created and improved during the following pull-request:
 * https://github.com/pr0-dev/Discord-Bot/pull/4#issuecomment-501845385
 * 
 * @see https://github.com/RundesBalli/regex-functions/blob/master/pr0gramm/postid-commentid.php
 * 
 * @param string The text where IDs are extracted from.
 * 
 * @return array An array with all post- and comment-ids. If there are none, it returns an empty array.
 */
function postid_commentid($text) {
  $regex = '/http(?:s?):\/\/pr0gramm\.com\/(?:top|new|user\/\w+\/(?:uploads|likes)|stalk)(?:(?:\/\w+)?)\/(\d+)(?:(?::)comment(\d+))?/im';
  preg_match_all($regex, $text, $matches);
  $ids = array();
  foreach($matches[1] as $key => $value) {
    $ids[] = array('postid' => $value, 'commentid' => (empty($matches[2][$key]) ? NULL : $matches[2][$key]));
  }
  return $ids;
}

/**
 * Example:
 * 
 * https://pr0gramm.com/                                           # doesn't match
 * https://pr0gramm.com/new                                        # doesn't match
 * https://pr0gramm.com/top                                        # doesn't match
 * https://pr0gramm.com/new/12345                                  # matches
 * https://pr0gramm.com/top/12345                                  # matches
 * https://pr0gramm.com/new/12345:comment12345                     # matches
 * https://pr0gramm.com/top/12345:comment12345                     # matches
 * https://pr0gramm.com/new/12345:comment                          # matches
 * https://pr0gramm.com/top/12345:comment                          # matches
 * https://pr0gramm.com/new/tag/12345                              # matches
 * https://pr0gramm.com/top/tag/12345                              # matches
 * https://pr0gramm.com/new/tag/12345:comment12345                 # matches
 * https://pr0gramm.com/top/tag/12345:comment12345                 # matches
 * https://pr0gramm.com/new/12345/12345                            # if the search tag is "12345", matches
 * https://pr0gramm.com/top/12345/12345                            # if the search tag is "12345", matches
 * https://pr0gramm.com/new/12345/12345:comment12345               # if the search tag is "12345", matches
 * https://pr0gramm.com/top/12345/12345:comment12345               # if the search tag is "12345", matches
 * https://pr0gramm.com/user                                       # doesn't match
 * https://pr0gramm.com/user/asdf                                  # doesn't match
 * https://pr0gramm.com/user/asdf/uploads                          # doesn't match
 * https://pr0gramm.com/user/asdf/likes                            # doesn't match
 * https://pr0gramm.com/user/asdf/uploads/12345                    # matches
 * https://pr0gramm.com/user/asdf/likes/12345                      # matches
 * https://pr0gramm.com/user/asdf/uploads/12345:comment12345       # matches
 * https://pr0gramm.com/user/asdf/likes/12345:comment12345         # matches
 * https://pr0gramm.com/user/asdf/uploads/tag/12345:comment12345   # matches
 * https://pr0gramm.com/user/asdf/likes/tag/12345:comment12345     # matches
 * https://pr0gramm.com/user/asdf/uploads/12345/12345:comment12345 # if the search tag is "12345", matches
 * https://pr0gramm.com/user/asdf/likes/12345/12345:comment12345   # if the search tag is "12345", matches
 * https://pr0gramm.com/stalk                                      # doesn't match
 * https://pr0gramm.com/stalk/12345                                # matches
 * https://pr0gramm.com/stalk/12345:comment12345                   # matches
 */
?>
