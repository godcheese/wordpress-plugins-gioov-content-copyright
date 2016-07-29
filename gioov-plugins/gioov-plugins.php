<?php

define('GIOOV_Author','Godcheese');
define('GIOOV_Author_URI','http://www.gioov.com/');
define('GIOOV_Page_Title','GIOOV Plugins');
define('GIOOV_Menu_Title','GIOOV Plugins');
define('GIOOV_Capability','manage_options');
define('GIOOV_Menu_Slug','gioov-plugins');
define('GIOOV_Function','gioov_plugins_html_page');
define('GIOOV_Icon_Url','');
define('GIOOV_Position',null);

function gioov_plugins_html_page(){
    echo '<h3></h3>';
}

/**
 * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
 * 添加后台菜单页面（页面标题，菜单标题，权限，菜单别名，回调函数[用于显示页面内容]，icon图标url，位置[]）
 *
 *
 */
function gioov_plugins_menu(){
    add_menu_page(GIOOV_Page_Title, GIOOV_Menu_Title, GIOOV_Capability, GIOOV_Menu_Slug, GIOOV_Function, GIOOV_Icon_Url, GIOOV_Position);
}

if(is_admin()){
    add_action('admin_menu','gioov_plugins_menu');
}
