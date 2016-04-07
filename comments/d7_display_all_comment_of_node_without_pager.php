<?php 
  /*
   * Implements hook_form_BASE_FORM_ID_alter()
   */
function CUSTOMMODULE_form_node_type_form_alter(&$form, &$form_state, $form_id) {

  // number of comments per page is stored in a variable 'comment_default_per_page_CONTENT_TYPE'
  // per content type
  // setting the number of comments per page to a high value will remove the pager

  if ($form['#node_type']->type == 'CONTENT_TYPE') {

    // add more options for comment quantity
    // in content type settings form

    $quantity_options = drupal_map_assoc(array(10, 30, 50, 70, 90, 150, 200, 250, 300, 500, 1000));
    $form['comment']['comment_default_per_page']['#options'] = $quantity_options;

  }
}

/*
 * this setting can also be controlled by overriding 'comment_default_per_page' variable
 * for the specific content type in settings.php file
 *
 * $conf['comment_default_per_page_CONTENT_TYPE'] = 1000;
 *
 * keep in mind that variable set like this can not be overridden by other actions
 * it is best to let user control 'number of comment per page' setting thru Content Type setting form
 */
?>