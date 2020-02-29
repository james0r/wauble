<?php
  /**
   * Query Variables
   */
   function custom_query_vars_filter($vars)
   {
       $vars[] .= 'category';
       return $vars;
   }
   add_filter('query_vars', 'custom_query_vars_filter');
