<?php
/*
 * Implements hook_form_alter()
 */
/*
 * Overrides values of checkout form fields provided by
 * Commerce Coupon module [https://www.drupal.org/project/commerce_coupon] 
 */
function CUSTOMMODULE_form_alter(&$form, &$form_state, $form_id) {
  switch ($form_id) {
    case 'commerce_checkout_form_checkout':
    // overrides the title of the coupon fieldset
    $form['commerce_coupon']['#title'] = t('Promo Code');
    // overrides the title of the coupon code field
    $form['commerce_coupon']['coupon_code']['#title'] = t('Enter your code here.');
    // overrides the description of the coupon code field
    $form['commerce_coupon']['coupon_code']['#description'] = '';
    // overrides text value of the coupon submit/apply button
    $form['commerce_coupon']['coupon_add']['#value'] = t('Apply Code');
    break;
  }
}

?>