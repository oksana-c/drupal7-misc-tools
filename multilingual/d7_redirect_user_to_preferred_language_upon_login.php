function yourthemename_user_login(&$edit, $account)
{
  // get current user's language from the user account
  $user_language = $account->language;

  // if account has no preferred language set - do nothing
  if (!$user_language) {
    return;
  }
  // if the language is set - do additional checks and then redirect
  else {
    // get a list of installed languages
    $languages = language_list();
    // check if language retrieved from user account exists 
    if (!isset($languages[$user_language])) {
      return;
    }
    else {
      // verify if language is enabled
      if (!$languages[$user_language]->enabled) {
        return;
      }
      else {
        // if enabled - redirect to user profile in preferred language
        $user_profile_url = drupal_get_path_alias('user/' . $account->uid);
        drupal_goto($user_profile_url, array(
          'language' => $languages[$user_language],
        ));
      }
    } 
  }
}
