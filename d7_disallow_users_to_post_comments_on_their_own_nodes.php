<?php
/**
* Implements hook_node_alter().
*/
function THEME_node_view_alter(&$build) {
  global $user;
  // get the uid of logged in user
  $logged_in_uid = $user->uid;

  // if content type is 'content_type_name'
  if ($build['#bundle'] == 'content_type_name') {

    //get node author's uid
    $node_author = $build['#node']->uid;

    // if logged in user is the node author - unset comment form and remove the 'Add comment' links from node display
    if ($node_author == $logged_in_uid) {
      unset($build['comments']['comment_form']);
      unset($build['links']['comment']['#links']['comment-add']);
    }
  }
}
?>
