UPDATE `wp_usermeta`
SET `meta_value` = 'false'
WHERE `wp_usermeta`.`meta_key` = 'show_admin_bar_front'
AND `wp_usermeta`.`user_id` = 1;