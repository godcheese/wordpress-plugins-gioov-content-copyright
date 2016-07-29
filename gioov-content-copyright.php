<?php
/*
Plugin Name: 内容版权声明
Plugin URI: http://www.gioov.com/index.php/wordpress-gioov-content-copyright/
Description: 添加设置页面、文章等内容正文版权信息，支持html/css代码。
Version: 1.0.0
Author: Godcheese
Author URI: http://www.gioov.com/
License: GPL2+
Text Domain: gioov-content-copyright
 */

/**
 *
 * gioov_content_copyright_activation 激活插件
 * gioov_content_copyright_deactivation 停用插件
 *
 * gioov_content_copyright_html_page 显示页面
 *
 * gioov_content_copyright_display4article 显示1，不显示0
 * gioov_content_copyright_value4article "文章版权"
 *
 * gioov_content_copyright_display4page 不显示0，显示1
 * gioov_content_copyright_value4page "页面版权"
 *
 *
 */

$plugin_name='内容版权声明';



function gioov_content_copyright_activation(){
    add_option('gioov_content_copyright_display4article',1);
    add_option('gioov_content_copyright_value4article','文章版权');
    add_option('gioov_content_copyright_display4page',0);
    add_option('gioov_content_copyright_value4page','页面版权');
}register_activation_hook(__FILE__,'gioov_content_copyright_activation');

include('gioov-plugins/gioov-plugins.php');

function gioov_content_copyright_deactivation(){
    delete_option('gioov_content_copyright_display4article');
    delete_option('gioov_content_copyright_value4article');
    delete_option('gioov_content_copyright_display4page');
    delete_option('gioov_content_copyright_value4page');
}register_deactivation_hook(__FILE__,'gioov_content_copyright_deactivation');

function gioov_content_copyright_html_page(){
    global $plugin_name;


    /**
     *
     *
     */

    //当提交了，并且验证信息正确
    if(!empty($_POST) && check_admin_referer('gioov_content_copyright_nonce')){
        update_option('gioov_content_copyright_display4article', $_POST['gioov_content_copyright_display4article']);
        update_option('gioov_content_copyright_value4article', $_POST['gioov_content_copyright_value4article']);
        update_option('gioov_content_copyright_display4page', $_POST['gioov_content_copyright_display4page']);
        update_option('gioov_content_copyright_value4page', $_POST['gioov_content_copyright_value4page']);
        ?>
        <div id="message" class="updated">
            <p><strong>保存成功！</strong></p>
        </div>
        <?php
    }

    ?>
    <div class="wrap">
        <form method="post" action="">
            <h2><?php echo $plugin_name; ?></h2>
            <hr/>

            <h3>文章版权声明</h3>
            <p><select name="gioov_content_copyright_display4article">
                    <option value="0" <?php selected(0,get_option('gioov_content_copyright_display4article')); ?>>不显示</option><option value="1" <?php selected(1,get_option('gioov_content_copyright_display4article')); ?>>显示</option>
                </select></p>
            <p><textarea name="gioov_content_copyright_value4article" cols="60" rows="6"><?php echo get_option('gioov_content_copyright_value4article'); ?></textarea></p>

            <hr/>

            <h3>页面版权声明</h3>
            <p><select name="gioov_content_copyright_display4page">
                    <option value="0" <?php selected(0,get_option('gioov_content_copyright_display4page')); ?>>不显示</option><option value="1" <?php selected(1,get_option('gioov_content_copyright_display4page')); ?>>显示</option>
                </select></p>
            <p><textarea name="gioov_content_copyright_value4page" cols="60" rows="6"><?php echo get_option('gioov_content_copyright_value4page'); ?></textarea></p>

            <?php wp_nonce_field('gioov_content_copyright_nonce'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function gioov_content_copyright_menu(){
    global $plugin_name;
    add_submenu_page('gioov-plugins',$plugin_name,$plugin_name,'manage_options','gioov-content-copyright','gioov_content_copyright_html_page');
}
is_admin() ? add_action('admin_menu','gioov_content_copyright_menu'):null;


function gioov_content_copyright_4article($content){
    if(is_single()) {
        $content .= get_option('gioov_content_copyright_value4article');
    }
    return $content;
}


if(get_option('gioov_content_copyright_display4article')!=0){
    add_filter('the_content','gioov_content_copyright_4article');
}

function gioov_content_copyright_4page($content){
    if(is_page()) {
        $content .= get_option('gioov_content_copyright_value4page');
    }
    return $content;
}

if(get_option('gioov_content_copyright_display4page')!=0) {
    add_filter('the_content', 'gioov_content_copyright_4page');
}























