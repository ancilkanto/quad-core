<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

class VCExtendAddonQCoreClass {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'qcore_members', array( $this, 'render_qcore_members' ) );

        // Register CSS and JS
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
    }
 
    public function integrateWithVC() {
        // Check if WPBakery Page Builder is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Extend WPBakery Page Builder is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
 
        /*
        Add your WPBakery Page Builder logic here.
        Lets call vc_map function to "register" our custom shortcode within WPBakery Page Builder interface.

        More info: http://kb.wpbakery.com/index.php?title=Vc_map
        */
        vc_map( array(
            "name" => __("Members List", 'vc_extend'),
            "description" => __("Displays members list.", 'vc_extend'),
            "base" => "qcore_members",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('../assets/icons/growth.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Quadnotion Addons', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('../assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('../assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                'type' => 'param_group',
                'heading' => __( 'Member', 'js_composer' ),
                'param_name' => 'members_list',
                'value' => urlencode( json_encode( array(
                  array(
                    'name' => __( 'Name', 'js_composer' ),
                    'image' => __( '', 'js_composer' ),
                    'url' => 'http://',
                  )
                ) ) ),
                'params' => array(
                  array(
                    'type' => 'textfield',
                    'heading' => __( 'Name', 'js_composer' ),
                    'param_name' => 'name',
                    'description' => __( '', 'js_composer' ),
                    'admin_label' => true
                  ),
                  array(
                      'type' => 'attach_image',
                      'heading' => __( 'Member Image', 'js_composer' ),
                      'param_name' => 'image',
                      'value' => '',
                      'description' => __( 'Select image from media library.', 'js_composer' )
                  ),
                  array(
                      "type" => "textfield",
                      "heading" => __("External URL", "js_composer"),
                      "param_name" => "url",
                      "description" => __("", "js_composer"),
                      
                  ),
                )
              ),
            )
        ) );
    }
    
    /*
    Shortcode logic how it should be rendered
    */
    public function render_qcore_members( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'members_list' => ''
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

      
     
      $output = '';

      return $output;
    }

    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function loadCssAndJs() {
      wp_register_style( 'vc_extend_style', plugins_url('../assets/vc_extend.css', __FILE__) );
      wp_enqueue_style( 'vc_extend_style' );

      // If you need any javascript files on front end, here is how you can load them.
      //wp_enqueue_script( 'vc_extend_js', plugins_url('../assets/vc_extend.js', __FILE__), array('jquery') );
    }

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }
}
// Finally initialize code
new VCExtendAddonQCoreClass();