<?php
/*
 * Implements hook_form_alter()
 */
function CUSTOMMODULE_form_alter(&$form, &$form_state, $form_id) {
  switch ($form_id) {
    case 'views_form_commerce_cart_form_default':
    /*
     * Overrides values of cart form 
     *
     * Disables "Product was removed from your cart" message
     * by removing the submit handler for the button "Remove" (in cart) 
     * 
     */
    foreach($form['edit_delete'] as $id => $delete) {
      if(isset($delete['#submit'])) {
        foreach($delete['#submit'] as $hid => $handler) {
          if($handler == 'commerce_cart_line_item_delete_form_submit') {
            unset($form['edit_delete'][$id]['#submit'][$hid]);
          }
        }
      }
    }
    break;
  }
}

?>