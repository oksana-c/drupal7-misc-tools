<?php 
/* 
 * Implements hook_preprocess_html()
 */
/* 
 * use in theme's template.php
 */
  function THEMENAME_preprocess_html(&$variables) {

    global $user;
    // custom title tags on user account pages
    // for CURRENTLY LOGGED IN USER

    if(arg(0)=='user' && is_numeric(arg(1)) && arg(1)==$user->uid) {

      //$user_data = user_load($user->uid);
      
      switch(arg(2)) {
        // change title tag of Change Password page
        case 'change-password' :
          $variables['head_title'] = t('Change Password');
          break;

        // change title tag of Account Edit page
        case 'edit' :
          $variables['head_title'] = t('Edit Account Information');
          break;

        // change title tag of User Orders page (for Drupal Commerce)
        case 'orders' :
          $variables['head_title'] = t('Transaction History');
          break;

        default:
          $variables['head_title'] = $user->name. '\'s '.t('Account');
      }

    }

    // custom title tags on user account pages
    // for CURRENTLY VIEWED USER

    elseif (arg(0)=='user' && is_numeric(arg(1)) && arg(1) !== $user->uid) {

      $viewed_user_id = arg(1);
      $viewed_user_data = user_load($viewed_user_id);

      switch(arg(2)) {
        // change title tag of Change Password page
        case 'change-password' :
          $variables['head_title'] = t('Change Password');
          break;

        // change title tag of Account Edit page
        case 'edit' :
          $variables['head_title'] = t('Edit Account Information');
          break;

        // change title tag of User Orders page (for Drupal Commerce)
        case 'orders' :
          $variables['head_title'] = t('Transaction History');
          break;

        default:
          $variables['head_title'] = $viewed_user_data->name. '\'s '.t('Account');
      }

    }

  }

/* 
 * Implements hook_preprocess_page()
 */
/* 
 * use in theme's template.php
 */
  function THEMENAME_preprocess_page(&$variables, $hook) {

    // customize H1#page-title on REGISTER, LOGIN, REQUEST PASSWORD pages

    if (arg(0) == 'user') {

      switch (arg(1)) {

        case 'register':
          $variables['title'] = t('Create a new account');
          drupal_set_title(t('Create account'));
          break;

        case 'password':
          $variables['title'] = t('Request new password');
          drupal_set_title(t('Request new password'));
          break;

        case '':
        case 'login':
          drupal_set_title(t('Sign In'));
          $variables['title'] = t('Sign In');
          
          break;

      }

    }

    global $user;

    // customize H1#page-title on User Account pages
    // for CURRENTLY LOGGED IN USER

    if(arg(0)=='user' && is_numeric(arg(1)) && arg(1)==$user->uid) {

      //$user_data = user_load($user->uid);
      
      switch(arg(2)) {
        // change title tag of Change Password page
        case 'change-password' :
          $variables['title'] = t('Change Your Password');
          break;

        // change title tag of Account Edit page
        case 'edit' :
          $variables['title'] = t('Edit Your Account Information');
          break;

        // change title tag of User Orders page (for Drupal Commerce)
        case 'orders' :
          $variables['title'] = t('Transaction History');
          break;

        default:
          $variables['title'] = t('My Account');
      }

    }

    // customize H1#page-title on User Account pages
    // for CURRENTLY VIEWED USER

    elseif (arg(0)=='user' && is_numeric(arg(1)) && arg(1) !== $user->uid) {

      $viewed_user_id = arg(1);
      $viewed_user_data = user_load($viewed_user_id);

      switch(arg(2)) {
        // change title tag of Change Password page
        case 'change-password' :
          $variables['title'] = t('Change Password');
          break;

        // change title tag of Account Edit page
        case 'edit' :
          $variables['title'] = t('Edit Account Information');
          break;

        // change title tag of User Orders page (for Drupal Commerce)
        case 'orders' :
          $variables['title'] = t('Transaction History');
          break;

        default:
          $variables['title'] = $viewed_user_data->name. '\'s '.t('Account');
      }

    }

  }

?>