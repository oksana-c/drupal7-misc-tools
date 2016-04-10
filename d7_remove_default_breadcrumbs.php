<?php 
/**
 * Implements hook_menu_breadcrumb_alter()
 */
function nest_menu_breadcrumb_alter(&$active_trail, $item){
  // removes default breadcrumbs
    $active_trail = array();
}
?>