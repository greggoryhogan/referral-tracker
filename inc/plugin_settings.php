<?php 
/*
 * Set settings for the plugin and explain how the shortcode works
 */

function referral_plugin_register_settings() {
    //what variable to check for
    add_option( 'referral_variable', 'ref');
    register_setting( 'referral_plugin_settings', 'referral_variable' );
    //default id if there isnt a variable set
    add_option( 'default_referral_id', 'followterry');
    register_setting( 'referral_plugin_settings', 'default_referral_id' );
    //cookie expiration in seconds
    add_option( 'cookie_expiration', '864000');
    register_setting( 'referral_plugin_settings', 'cookie_expiration' );
    //class for buttons
    add_option( 'button_class', 'btn');
    register_setting( 'referral_plugin_settings', 'button_class' );
}
add_action( 'admin_init', 'referral_plugin_register_settings' );

function eos_admin_pages() {
    add_menu_page('Referral Tracker','Referral Tracker', 'manage_options','referral-tracker-settings','referral_tracker_options_page','dashicons-admin-generic',5);
}
add_action( 'admin_menu', 'eos_admin_pages' );    
    
function referral_tracker_options_page() { ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h1>Referral Tracker</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'referral_plugin_settings' ); ?>
            <h2>Referral Tracker Settings</h2>
            <p>Use the area below to set the default options for the plugin.</p>
            
            <p><strong>Variable to Track:</strong><br>
            <em>https://example.com/?ref=x&action=y the variable would be ref</em><br>
            <input type="text" id="referral_variable" name="referral_variable" value="<?php echo get_option('referral_variable'); ?>" /></p>

            <p><strong>Default Tracker:</strong><br>
            <em>What code to insert when no tracker has been defined for the user</em><br>
            <input type="text" id="default_referral_id" name="default_referral_id" value="<?php echo get_option('default_referral_id'); ?>" /></p>

            <p><strong>Cookie Expiration:</strong><br>
            <em>Expiration in seconds. 864000 = 10 days = 10 * 24 * 60 *60</em><br>
            <input type="text" id="cookie_expiration" name="cookie_expiration" value="<?php echo get_option('cookie_expiration'); ?>" />

            <p><strong>Class for Buttons:</strong><br>
            <em>Specify the class for buttons in your stylesheet</em><br>
            <input type="text" id="button_class" name="button_class" value="<?php echo get_option('button_class'); ?>" />
            
            <?php submit_button(); ?>
        </form>
            
        <h2>Referral Tracker Shortcode</h2>
        <code>[referral_link link="https://example.com/|*referral*|" text="Click here to redeem" type="text" target="_blank"]</code>
        <p><strong>Options:</strong><br>
        Link: Use any link and use the placeholder |*referral*| where you want the referral to be replaced.<br>
        Text: Text for your link or button<br>
        Type: 'text', 'button' or 'inline'. An inline referral link will remove the link wrapper and just output the appropriate text. To use as a button, make sure the button class in the settings matches your theme.<br>
        Target: _blank, _parent, _self, _top</p> 

        <code>[referrer_text]</code>
        <p><strong>This shortcode has not options</strong><br>
        It will show the current set referrer on the page, pulled from either the $_GET, $_COOKIE, or Default value</p> 
         
    </div>
<?php
}
?>