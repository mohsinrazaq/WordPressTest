<?php
/**
 * Other settings page - admin 
 * 
 * this main settings page contains .. 
 * 
 *  Analytics, .. 
 * 
 * @package ctc
 * @subpackage admin
 * @since 3.0 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Admin_Other_Settings' ) ) :

class HT_CTC_Admin_Other_Settings {

    public function menu() {

        add_submenu_page(
            'click-to-chat',
            'Other-Settings',
            'Other Settings',
            'manage_options',
            'click-to-chat-other-settings',
            array( $this, 'settings_page' )
        );

        if ( ! defined( 'HT_CTC_PRO_VERSION' ) ) {
            add_submenu_page(
                'click-to-chat',
                __('Go Premium', 'click-to-chat-for-whatsapp'),
                '<span class="dashicons dashicons-star-filled" style="color: #ff8c00"></span><span id="ht-ctc-go-pro-link" style="color: #ff8c00;font-weight: 500;display: inline-block;margin-left: 5px;margin-top: 2px;">' . __('Go Premium', 'click-to-chat-for-whatsapp') . '</span>',
                'manage_options',
                'https://holithemes.com/plugins/click-to-chat/pricing/'
            );
        }

    }

    public function settings_page() {

        if ( ! current_user_can('manage_options') ) {
            return;
        }

        ?>

        <div class="wrap ctc-admin-other-settings">

            <?php settings_errors(); ?>

            <div class="row">
                <div class="col s12 m12 xl8 options">
                    <form action="options.php" method="post" class="">
                        <?php settings_fields( 'ht_ctc_os_page_settings_fields' ); ?>
                        <?php do_settings_sections( 'ht_ctc_os_page_settings_sections_do' ) ?>
                        <?php submit_button() ?>
                    </form>
                </div>
                <!-- <div class="col s12 m12 xl6 ht-ctc-admin-sidebar">
                </div> -->
            </div>

            <!-- new row - After settings page  -->
            <div class="row">
                
                <!-- after settings page -->
                <?php // include_once HT_CTC_PLUGIN_DIR .'new/admin/admin_commons/admin-after-settings-page.php'; ?>
                    
            </div>


        </div>

        <?php

    }

    public function settings() {

        register_setting( 'ht_ctc_os_page_settings_fields', 'ht_ctc_othersettings' , array( $this, 'options_sanitize' ) );
        
        add_settings_section( 'ht_ctc_os_settings_sections_add', '', array( $this, 'main_settings_section_cb' ), 'ht_ctc_os_page_settings_sections_do' );
        
        add_settings_field( 'ht_ctc_animations', 'Animations', array( $this, 'ht_ctc_animations_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        add_settings_field( 'ht_ctc_analytics', 'Analytics', array( $this, 'ht_ctc_analytics_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        add_settings_field( 'ht_ctc_webhooks', 'Webhooks', array( $this, 'ht_ctc_webhooks_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        add_settings_field( 'ht_ctc_othersettings', 'Advanced Settings', array( $this, 'ht_ctc_othersettings_cb' ), 'ht_ctc_os_page_settings_sections_do', 'ht_ctc_os_settings_sections_add' );
        
    }

    public function main_settings_section_cb() {
        ?>
        <h1>Other Settings</h1>
        <div class="ctc_admin_top_menu" style="float:right; margin:0px 18px;">
            <a href="#ht_ctc_analytics">Analytics</a> | <a href="#ht_ctc_webhooks">Webhooks</a>
        </div>
        <?php
        do_action('ht_ctc_ah_admin' );
    }

    function ht_ctc_analytics_cb() {

        $options = get_option('ht_ctc_othersettings');
        $dbrow = 'ht_ctc_othersettings';

        ?>
        <ul class="collapsible ht_ctc_analytics" data-collapsible="accordion" id="ht_ctc_analytics">
        <li class="">
        <div class="collapsible-header"><?php _e( 'Google Analytics, Facebook Pixel, Google Ads Conversion', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        
        <?php

        // Google Analytics
        if ( isset( $options['google_analytics'] ) ) {
            ?>
            <p>
                <label>
                    <input name="<?= $dbrow; ?>[google_analytics]" type="checkbox" value="1" <?php checked( $options['google_analytics'], 1 ); ?> id="google_analytics" />
                    <span><?php _e( 'Google Analytics', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
        ?>
        <p>
            <label>
                <input name="<?= $dbrow; ?>[google_analytics]" type="checkbox" value="1" id="google_analytics" />
                <span><?php _e( 'Google Analytics', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
        </p>
        <?php
        }

        // ga4
        if ( isset( $options['ga4'] ) ) {
            ?>
            <p class="ctc_ga4" style="margin-left:40px;">
                <label>
                    <input name="<?= $dbrow; ?>[ga4]" type="checkbox" value="1" <?php checked( $options['ga4'], 1 ); ?> id="ga4" />
                    <span><?php _e( 'If Google Analytics 4 is installed', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_ga4" style="margin-left:40px;">
                <label>
                    <input name="<?= $dbrow; ?>[ga4]" type="checkbox" value="1" id="ga4" />
                    <span><?php _e( 'If Google Analytics 4 is installed', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
            }
        ?>
        <p class="description"><?php _e( 'If Google Analytics installed creates an Event there', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/google-analytics/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        <br>


        <?php

        // Facebook Pixel
        if ( isset( $options['fb_pixel'] ) ) {
            ?>
            <p>
                <label>
                    <input name="<?= $dbrow; ?>[fb_pixel]" type="checkbox" value="1" <?php checked( $options['fb_pixel'], 1 ); ?> id="fb_pixel" />
                    <span><?php _e( 'Facebook Pixel', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        } else {
        ?>
        <p>
            <label>
                <input name="<?= $dbrow; ?>[fb_pixel]" type="checkbox" value="1" id="fb_pixel" />
                <span><?php _e( 'Facebook Pixel', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
        </p>
        <?php
        }
        ?>
        <p class="description"><?php _e( 'If Facebook Pixel installed creates an Event there', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/facebook-pixel/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        <br>

        <?php

        do_action('ht_ctc_ah_admin_after_fb_pixel');


        // Google Ads gtag_report_conversion
        $ga_ads_checkbox = ( isset( $options['ga_ads']) ) ? esc_attr( $options['ga_ads'] ) : '';
        
        /**
         * @updated 3.8
         */

        if ( ! defined( 'HT_CTC_PRO_VERSION' ) ) {
            ?>
            <p class="description ht_ctc_subtitle"><?php _e( 'Google Ads Conversion', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/google-ads-conversion/">PRO</a></p>
            <?php
        }

        // enable, conversion id, label
        do_action('ht_ctc_ah_admin_google_ads');

        $analytics = ( isset( $options['analytics']) ) ? esc_attr( $options['analytics'] ) : 'all';
        $analytics_list = array(
            'all' => 'All Clicks',
            'session' => 'One click per session'
        );

        $analytics_message = 'All Clicks';
        if (isset($analytics_list["$analytics"])) {
            $analytics_message = $analytics_list["$analytics"];
        }
        
        ?>

        <br>
        <div class="analytics_count">
            <p class="description analytics_count_message"><?php _e( 'Analytics', 'click-to-chat-for-whatsapp' ); ?>: <span class="" style="cursor:pointer; border-bottom: 1px dotted;"><?= $analytics_message ?></span></p>
            <div class="analytics_count_select ctc_init_display_none">
                <select name="ht_ctc_othersettings[analytics]" class="select_analytics" style="border:unset; background-color:inherit;">
                    <?php 
                    foreach ( $analytics_list as $key => $value ) {
                    ?>
                    <option value="<?= $key ?>" <?= $analytics == $key ? 'SELECTED' : ''; ?> ><?= $value ?></option>
                    <?php
                    }
                    ?>
                </select>
                <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/analytics-count/">Analytics Count</a></p>
            </div>
        </div>
        
        <?php
        
        if ( ! defined( 'HT_CTC_PRO_VERSION' ) ) {
            ?>
            <p class="description"><span class="ga_ads_display" style="font-size: 0.7em;">Call <span style="cursor:pointer; border-bottom: 1px dotted;">gtag_report_conversion</span></span></p>
            <div class="ga_ads_checkbox" style="display:none; margin: 20px 0px 0px 20px;">
                <p class="description">This feature requires to add JavaScript code on your website i.e. add gtag_report_conversion function</p>
                <p>
                    <label>
                        <input name="<?= $dbrow; ?>[ga_ads]" type="checkbox" value="1" <?php checked( $ga_ads_checkbox, 1 ); ?> id="ga_ads" />
                        <span><?php _e( 'call gtag_report_conversion function', 'click-to-chat-for-whatsapp' ); ?></span>
                    </label>
                </p>
                <p class="description"><?php _e( 'call gtag_report_conversion function, when user clicks', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/call-gtag_report_conversion-function/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
                <br>
                <p class="description"><a href="https://holithemes.com/plugins/click-to-chat/google-ads-conversion/"><strong>PRO</strong></a>: Add Conversion ID, Conversion label direclty (no need to setup gtag_report_conversion function)</p>
            </div>
            <?php
        }
        ?>

        </div>
        </li>
        </ul>
        <?php
    }

    // webhook
    function ht_ctc_webhooks_cb() {

        $options = get_option('ht_ctc_othersettings');
        $dbrow = 'ht_ctc_othersettings';

        $hook_url = isset($options['hook_url']) ? esc_attr( $options['hook_url'] ) : '';

        ?>
        <ul class="collapsible ht_ctc_webhooks" data-collapsible="accordion" id="ht_ctc_webhooks">
        <li class="">
        <div class="collapsible-header"><?php _e( 'Webhooks', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        
        <p class="description" style="margin-bottom: 40px;"><?php _e( 'Integrate, Automation', 'click-to-chat-for-whatsapp' ); ?> <?php _e( 'using', 'click-to-chat-for-whatsapp' ); ?> <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/webhooks/"><?php _e( 'Webhooks', 'click-to-chat-for-whatsapp' ); ?></a></p>

        <!-- Webhook URL -->
        <div class="row">
            <div class="input-field col s12">
                <input name="<?= $dbrow; ?>[hook_url]" value="<?= $hook_url ?>" id="hook_url" type="text" class="input-margin">
                <label for="hook_url"><?php _e( 'Webhook URL', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description"><?php _e( 'Calls this webhook url after user clicks on WhatsApp Icon/Button', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
        </div>

        <div class="row">
        
            <br>
            <div class="ctc_hook_value ctc_sortable">
                <?php

                // hook values
                $hook_v = (isset($options['hook_v'])) ? $options['hook_v'] : '' ;
                $count = 1;
                $num = '';

                if ( is_array($hook_v) ) {
                    $hook_v = array_filter($hook_v);
                    $hook_v = array_values($hook_v);
                    $count = count($hook_v);
                }

                // hook values
                if ( isset( $hook_v[0] ) ) {
                    for ($i=0; $i < $count ; $i++) {
                        $dbrow = "ht_ctc_othersettings[hook_v][$i]";
                        $num = $hook_v[$i];
                        ?>
                        <div class="additional-value row" style="margin-bottom: 15px;">
                            <div class="col s3">
                                <p class="description handle">Value<?= $i+1; ?></p>
                            </div>
                            <div class="col s9 m6">
                                <p style="display: flex;">
                                    <input name="<?= $dbrow; ?>" value="<?= $num; ?>" type="text"/>
                                    <span style="color:lightgrey; cursor:pointer;" class="hook_remove_value dashicons dashicons-no-alt"></span>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                }
                
                ?>
            </div>
                    
            <span style="color:#039be5; cursor:pointer; font-size:16px;" 
            class="add_hook_value dashicons dashicons-plus-alt2 col s12" 
            data-html='<div class="row additional-value"><div class="col s3"><p class="description"><?php _e( "Add Value", "click-to-chat-for-whatsapp" ); ?></p></div><div class="input-field col s9 m6" style="display: flex;"><input name="ht_ctc_othersettings[hook_v][]" value="" id="hook_v" type="text" class="input-margin"><label for="hook_v"><?php _e( "Value", "click-to-chat-for-whatsapp" ); ?></label><span style="color:lightgrey; cursor:pointer;" class="hook_remove_value dashicons dashicons-no-alt"></span></div></div>' 
            ><?php _e( "Add Value", "click-to-chat-for-whatsapp" ); ?></span>
            
        </div>
        <?php
        if ( ! defined( 'HT_CTC_PRO_VERSION' ) ) {
            ?>
            <p class="description">Webhook Dynamic Variables - {number}, {url}, {time} - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/webhooks/#pro">PRO</a></p>
            <?php
        }
        ?>
       

        </div>
        </li>
        </ul>
        <?php
    }

    // animations
    function ht_ctc_animations_cb() {

        $options = get_option('ht_ctc_othersettings');
        $dbrow = 'ht_ctc_othersettings';

        $greetings = get_option('ht_ctc_greetings_options');
        $greetings_settings = get_option('ht_ctc_greetings_settings');

        $show_effect = ( isset( $options['show_effect']) ) ? esc_attr( $options['show_effect'] ) : 'no-show-effects';
        $an_delay = ( isset( $options['an_delay']) ) ? esc_attr( $options['an_delay'] ) : '';
        $an_itr = ( isset( $options['an_itr']) ) ? esc_attr( $options['an_itr'] ) : '';

        $entry_effect_list = array(
            'no-show-effects' => '--No-Show-Effects--',
            'From Center' => 'Center (zoomIn)',
            'From Corner' => 'Corner (corner of icon)', // js 
            // // new
            // 'bounceIn' => 'bounceIn',
            // 'bounceInDown' => 'bounceInDown',
            // 'bounceInUP' => 'bounceInUP',
            // 'bounceInLeft' => 'bounceInLeft',
            // 'bounceInRight' => 'bounceInRight',
            // // 'bottomRight' => 'bottomRight', //add bounce effect
        );
        
        $an_type = ( isset( $options['an_type']) ) ? esc_attr( $options['an_type'] ) : '';
        
        $an_list = array(
            'no-animation' => '--No-Animation--',
            'bounce' => 'Bounce',
            'flash' => 'Flash',
            'pulse' => 'Pulse',
            'heartBeat' => 'HeartBeat',
            'flip' => 'Flip',
        );

        ?>
        <ul class="collapsible ht_ctc_animations" data-collapsible="accordion">
        <li class="">
        <div class="collapsible-header"><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">

        <p class="description" style="margin-bottom:25px;"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/animations/"><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></a></p>

        <!-- animation on load -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <select name="ht_ctc_othersettings[an_type]" class="select_an_type">
                <?php 
                
                foreach ( $an_list as $key => $value ) {
                ?>
                <option value="<?= $key ?>" <?= $an_type == $key ? 'SELECTED' : ''; ?> ><?= $value ?></option>
                <?php
                }

                ?>
                </select>
                <label><?php _e( 'Animations', 'click-to-chat-for-whatsapp' ); ?></label>
            </div>
        </div>

        <!-- animation delay -->
        <div class="row an_delay">
            <div class="col s6">
                <p><?php _e( 'Animation Delay', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?= $dbrow; ?>[an_delay]" value="<?= $an_delay ?>" id="an_delay" type="number" min="0" class="" >
                <label for="an_delay"><?php _e( 'Animation Delay', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description"><?php _e( 'E.g. Add 1 for 1 second delay', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
        </div>

        <!-- animation iteration -->
        <div class="row an_itr">
            <div class="col s6">
                <p><?php _e( 'Animation Iteration', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?= $dbrow; ?>[an_itr]" value="<?= $an_itr ?>" id="an_itr" type="number" min="1" class="" >
                <label for="an_itr"><?php _e( 'Animation Iteration', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description"><?php _e( 'E.g. Add 2 to repeat animation 2 times', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
        </div>

        <hr style="width: 50%;">
        <br><br>

        <!-- Show effect -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'Entry Effects', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <select name="ht_ctc_othersettings[show_effect]" class="show_effect">
                <?php 
                foreach ( $entry_effect_list as $key => $value ) {
                ?>
                <option value="<?= $key ?>" <?= $show_effect == $key ? 'SELECTED' : ''; ?> ><?= $value ?></option>
                <?php
                }

                ?>
                </select>
                <label><?php _e( 'Entrance Effects', 'click-to-chat-for-whatsapp' ); ?></label>
            </div>
        </div>

        </div>
        </li>
        </ul>


        <?php
        // notification Badge

        $notification_badge = (isset($options['notification_badge'])) ? 1 : '';
        $notification_count = ( isset( $options['notification_count']) ) ? esc_attr( $options['notification_count'] ) : '1';
        $notification_bg_color = (isset($options['notification_bg_color'])) ? esc_attr($options['notification_bg_color']) : '#ff4c4c';
        $notification_text_color = (isset($options['notification_text_color'])) ? esc_attr($options['notification_text_color']) : '#ffffff';
        $notification_border_color = (isset($options['notification_border_color'])) ? esc_attr($options['notification_border_color']) : '';
        $notification_time = (isset($options['notification_time'])) ? esc_attr($options['notification_time']) : '';
        ?>

        <ul class="collapsible ht_ctc_notification" data-collapsible="accordion" style="margin-top: 2rem;">
        <li class="">
        <div class="collapsible-header"><?php _e( 'Notification Badge', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">

        <p class="description" style="margin-bottom:25px;">New feature: since 3.26. For any queries or suggestion, please <a target="_blank" href="https://wordpress.org/support/plugin/click-to-chat-for-whatsapp/#new-topic-0">contact us</a></p>

        <p class="description" style="margin-bottom:25px;"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/notification-badge/"><?php _e( 'Notification Badge', 'click-to-chat-for-whatsapp' ); ?></a></p>

        <!-- notification_badge -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'Add Notification Badge', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="col s6">
                <label>
                    <input class="notification_field" name="<?php echo $dbrow ?>[notification_badge]" type="checkbox" value="1" <?php checked( $notification_badge, 1 ); ?> id="notification_badge" />
                    <span><?php _e( 'Add Notification Badge', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
                <br>
            </div>
        </div>

        <!-- notification_count -->
        <div class="row notification_settings notification_count">
            <div class="col s6">
                <p><?php _e( 'Notification Count', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?= $dbrow; ?>[notification_count]" value="<?= $notification_count ?>" id="notification_count" type="number" min="0" class="notification_field" >
                <label for="notification_count"><?php _e( 'Notification Count', 'click-to-chat-for-whatsapp' ); ?></label>
            </div>
        </div>

        <!-- notification_bg_color -->
        <div class="row notification_settings notification_bg_color">
            <div class="col s6">
                <p><?php _e( 'Badge Background Color', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input class="ht-ctc-color" name="<?= $dbrow; ?>[notification_bg_color]" data-default-color="#ff4c4c" value="<?= $notification_bg_color ?>" type="text">
            </div>
        </div>

        <!-- notification_text_color -->
        <div class="row notification_settings notification_text_color">
            <div class="col s6">
                <p><?php _e( 'Text Color', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input class="ht-ctc-color" name="<?= $dbrow; ?>[notification_text_color]" data-default-color="#ffffff" value="<?= $notification_text_color ?>" type="text">
            </div>
        </div>

        <!-- notification_border_color -->
        <div class="row notification_settings notification_border_color">
            <div class="col s6">
                <p><?php _e( 'Add border Color', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input class="ht-ctc-color" name="<?= $dbrow; ?>[notification_border_color]" value="<?= $notification_border_color ?>" type="text">
            </div>
        </div>

        <!-- notification_time -->
        <div class="row notification_settings notification_time">
            <div class="col s6">
                <p><?php _e( 'Badge Time Delay', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?= $dbrow; ?>[notification_time]" value="<?= $notification_time ?>" id="notification_time" type="number" min="0" class="notification_field" >
                <label for="notification_time"><?php _e( 'Time in seconds', 'click-to-chat-for-whatsapp' ); ?></label>
            </div>
        </div>

        <div class="row notification_settings">
            <p class="descripton" style="font-style=italic;">Notification badge will display until the first time user clicks to open chat or the greetings dialog.</p>
            <?php
            $greetings_template = ( isset( $greetings['greetings_template']) ) ? esc_attr( $greetings['greetings_template'] ) : '';
            $g_init = isset($greetings_settings['g_init']) ? esc_attr( $greetings_settings['g_init'] ) : '';
            if ( ('' !== $greetings_template || 'no' !== $greetings_template) && 'open' == $g_init) {
                $greetings_page_url = admin_url( 'admin.php?page=click-to-chat-greetings' );
                ?>
                <p class="description" style="color:#ff4c4c;">If the <a href="<?= $greetings_page_url . '#g_init:~:text=initial%20stage' ?>" target="_blank">Greetings dialog initial stage is open</a>, the notification badge maynot be displayed.</p>
                <?php
            }
            ?>
        </div>

        </div>
        </li>
        </ul>

        <?php
    }

    /**
     * Other settings
     *  detect device
     */
    function ht_ctc_othersettings_cb() {

        $options = get_option('ht_ctc_othersettings');
        $chat_options = get_option('ht_ctc_chat_options');
        $dbrow = 'ht_ctc_othersettings';

        $aria = (isset($options['aria'])) ? 1 : '';
        $zindex = (isset($options['zindex'])) ? esc_attr($options['zindex']) : '99999999';

        // start other settings
        do_action('ht_ctc_ah_admin_start_os');

        $li_active_gr_sh = ( isset( $options['enable_group'] ) || isset( $options['enable_share'] ) ) ? "class='active'" : '';

        ?>


        <p class="description"><?php _e( 'All these below settings are not important to everyone', 'click-to-chat-for-whatsapp' ); ?></p>
        <ul class="collapsible ht_ctc_other_settings" data-collapsible="accordion" id="ht_ctc_othersettings">
        <li class="">
        <div class="collapsible-header">Advanced Settings</div>
        <div class="collapsible-body">

        <!-- z-index -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'z-index', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="input-field col s6">
                <input name="<?= $dbrow; ?>[zindex]" value="<?= $zindex ?>" min="0" id="zindex" type="number">
                <label for="zindex"><?php _e( 'z-index', 'click-to-chat-for-whatsapp' ); ?></label>
                <p class="description"><?php _e( 'Position of the element along with z-index. stacking the elements', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
        </div>        

        <!-- aria -->
        <div class="row">
            <div class="col s6">
                <p><?php _e( 'Add aria-hidden=true', 'click-to-chat-for-whatsapp' ); ?></p>
            </div>
            <div class="col s6">
                <label>
                    <input name="<?php echo $dbrow ?>[aria]" type="checkbox" value="1" <?php checked( $aria, 1 ); ?> id="aria" />
                    <span><?php _e( 'Add aria-hidden=true', 'click-to-chat-for-whatsapp' ); ?></span>
                    <p class="description"><?php _e( 'hide for Accessibility API (screen readers)', 'click-to-chat-for-whatsapp' ); ?></p>
                </label>
                <br>
            </div>
        </div>


        <?php
        // webhook data Format
        $webhook_format_list = array(
            'string' => 'String (Stringify JSON)',
            'json' => 'JSON'
        );

        $webhook_format = ( isset( $options['webhook_format']) ) ? esc_attr( $options['webhook_format'] ) : 'string';
        ?>

        <div class="row">
            <div class="col s6">
                <p>Webhook data format</p>
            </div>
            <div class="input-field col s6">
                <select name="ht_ctc_othersettings[webhook_format]" class="select_webhook_format" style="border:unset; background-color:inherit;">
                    <?php 
                    foreach ( $webhook_format_list as $key => $value ) {
                    ?>
                    <option value="<?= $key ?>" <?= $webhook_format == $key ? 'SELECTED' : ''; ?> ><?= $value ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label>Webhook data format</label>
                <p class="description">Stringify JSON works. If any application need to change - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/webhook-data-format/">more info</a></p>
            </div>
        </div>


        <?php
        // hook
        // in other settings
        do_action('ht_ctc_ah_admin_in_os');
        ?>
        </div>
        </li>
        </ul>
        <br>

        <!-- enable group, share features -->
        <ul class="collapsible ht_ctc_enable_share_group" data-collapsible="accordion" id="ht_ctc_enable_share_group">
        <li <?= $li_active_gr_sh; ?>>
        <div class="collapsible-header"><?php _e( 'Group, Share features', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        
        <?php

        // enable group
        if ( isset( $options['enable_group'] ) ) {
        ?>
        <p>
            <label>
                <input name="ht_ctc_othersettings[enable_group]" type="checkbox" value="1" <?php checked( $options['enable_group'], 1 ); ?> id="enable_group" />
                <span><?php _e( 'Enable Group Features', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
            <p class="description"> <?php _e( 'Adds WhatsApp Icon for Group', 'click-to-chat-for-whatsapp' ); ?> - <a href="<?= admin_url( 'admin.php?page=click-to-chat-group-feature' ); ?>"><?php _e( 'Group Settings page', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        </p>
        <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[enable_group]" type="checkbox" value="1" id="enable_group" />
                    <span><?php _e( 'Enable Group Features', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <p class="description"> <?php _e( 'Adds WhatsApp Icon for Group', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/enable-group-feature/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
            <?php
        }
        ?>
        <br>
        <?php


        // enable share
        if ( isset( $options['enable_share'] ) ) {
        ?>
        <p>
            <label>
                <input name="ht_ctc_othersettings[enable_share]" type="checkbox" value="1" <?php checked( $options['enable_share'], 1 ); ?> id="enable_share" />
                <span><?php _e( 'Enable Share Features', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
            <p class="description"> <?php _e( 'Adds WhatsApp Icon for Share', 'click-to-chat-for-whatsapp' ); ?> - <a href="<?= admin_url( 'admin.php?page=click-to-chat-share-feature' ); ?>"><?php _e( 'Share Settings page', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        </p>
        <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[enable_share]" type="checkbox" value="1" id="enable_share" />
                    <span><?php _e( 'Enable Share Features', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <p class="description"> <?php _e( 'Adds WhatsApp Icon for Share', 'click-to-chat-for-whatsapp' ); ?> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/enable-share-feature/"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
            <?php
        }
        ?>
        <br>
        
        <!-- chat -->
        <p class="description"><?php _e( "Chat settings are enabled by default. If like to hide chat on all pages", 'click-to-chat-for-whatsapp' ); ?></p>
        <p class="description"><?php _e( "'Click to Chat' - 'Display Settings' - 'Global' - check ", 'click-to-chat-for-whatsapp' ); ?> <a target="_blank" href="<?= admin_url( 'admin.php?page=click-to-chat#showhide_settings' ); ?>"><?php _e( "Hide on all pages", 'click-to-chat-for-whatsapp' ); ?></a> - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/enable-chat"><?php _e( 'more info', 'click-to-chat-for-whatsapp' ); ?></a> </p>
        <br>


        </div>
        </li>
        </ul>

        <br>

        <!-- Troubleshoot, Debug, ..  -->
        <ul class="collapsible ht_ctc_debug" data-collapsible="accordion" id="ht_ctc_debug">
        <li>
        <div class="collapsible-header"><?php _e( 'Debug, Troubleshoot, ..', 'click-to-chat-for-whatsapp' ); ?></div>
        <div class="collapsible-body">
        <?php

        /**
         * AMP Compatibility - enabled by default.  (if an issue uncheck this..)
         * later version remove this option and make enable by default..
         * if amp related issue, uncheck this option
         */

        $amp_checkbox = ( isset( $options['amp']) ) ? esc_attr( $options['amp'] ) : '';

        if ( function_exists( 'amp_is_request' ) ) {
            ?>
            <p id="amp_compatibility">
                <label>
                    <input name="<?= $dbrow; ?>[amp]" type="checkbox" value="1" <?php checked( $amp_checkbox, 1 ); ?> id="amp" />
                    <span><?php _e( 'AMP Compatibility', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/amp-compatibility/"><?php _e( 'AMP Compatibility', 'click-to-chat-for-whatsapp' ); ?></a> If any issue, uncheck this option and please contact us</p>
            <br>
            <?php
        } else {
            // if amp is activated after this settings.
            ?>
            <label style="display: none;">
                <input name="<?= $dbrow; ?>[amp]" type="checkbox" value="1" <?php checked( $amp_checkbox, 1 ); ?> id="amp" />
                <span><?php _e( 'AMP Compatibility', 'click-to-chat-for-whatsapp' ); ?></span>
            </label>
            <?php
        }

        $debug_mode = ( isset( $options['debug_mode']) ) ? esc_attr( $options['debug_mode'] ) : '';
        $chat_load_hook = ( isset( $options['chat_load_hook']) ) ? esc_attr( $options['chat_load_hook'] ) : '';

        // debug mode 
        if ( isset( $options['debug_mode'] ) || (isset($_GET) && isset($_GET['debug'])) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_othersettings[debug_mode]" type="checkbox" value="1" <?php checked( $debug_mode, 1 ); ?> id="debug_mode"   />
                    <span><?php _e( 'Debug mode', 'click-to-chat-for-whatsapp' ); ?></span>
                </label>
            </p>
            <?php
        }

        ?>

        <p class="description">
            <ol style="list-style-type: disc;">

                <li>Basic Troubleshoot
                    <ol>
                        <ul>Clear Cache from cache plugins</ul>
                        <ul>Clear Server side cache if exists</ul>
                        <ul>Check display settings</ul>
                    </ol>
                </li>

                <li>
                    <ul><p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/faq"><?php _e( 'FAQ', 'click-to-chat-for-whatsapp' ); ?> (<?php _e( 'Frequently Asked Questions', 'click-to-chat-for-whatsapp' ); ?>)</a></p></ul>
                </li>
            
                <!-- <li><?php _e( 'If any issue? Please, contact us', 'click-to-chat-for-whatsapp' ); ?> 
                    <ul><?php _e( 'Chat', 'click-to-chat-for-whatsapp' ); ?>: <a target="_blank" href="https://api.whatsapp.com/send?phone=919494429789&text=Hi%20HoliThemes,%20I%20have%20a%20question"><?php _e( 'WhatsApp', 'click-to-chat-for-whatsapp' ); ?></a></ul>
                    <ul><?php _e( 'Mail', 'click-to-chat-for-whatsapp' ); ?>: <a href="mailto:ctc@holithemes.com">ctc@holithemes.com</a> </ul>
                </li> -->
            </ol>
        </p>
        <!-- <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/link/">Basic Troubleshooting</a></p> -->
        <br>
        <hr>
        <details>
            <summary style="cursor:pointer; margin-bottom: 5px;" class="description">Chat load hook</summary>

            <br>
            <!-- chat load hook -->
            <div class="row">
                <div class="input-field col s6">
                    <select name="<?= $dbrow; ?>[chat_load_hook]" class="chat_load_hook">
                        <option value="wp_footer" <?= $chat_load_hook == 'wp_footer' ? 'SELECTED' : ''; ?> >wp_footer</option>
                        <option value="get_footer" <?= $chat_load_hook == 'get_footer' ? 'SELECTED' : ''; ?> >get_footer</option>
                        <option value="wp_head" <?= $chat_load_hook == 'wp_head' ? 'SELECTED' : ''; ?> >wp_head</option>
                    </select>
                    <label>Chat load hook</label>
                    <p class="description">If the chat widget is not working with the wp_footer hook, change to get_footer or wp_head - <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/chat-load-hook/">more info</a></p>
                </div>
            </div>
        </details>

        <details>
            <summary style="cursor:pointer;" class="description">Delete settings</summary>
            <?php

            // delete options 
            if ( isset( $options['delete_options'] ) ) {
                ?>
                <p>
                    <label>
                        <input name="ht_ctc_othersettings[delete_options]" type="checkbox" value="1" <?php checked( $options['delete_options'], 1 ); ?> id="delete_options"   />
                        <span><?php _e( 'Delete this plugin settings when uninstalls', 'click-to-chat-for-whatsapp' ); ?></span>
                    </label>
                </p>
                <?php
            } else {
                ?>
                <p>
                    <label>
                        <input name="ht_ctc_othersettings[delete_options]" type="checkbox" value="1" id="delete_options"   />
                        <span><?php _e( 'Delete this plugin settings when uninstalls', 'click-to-chat-for-whatsapp' ); ?></span>
                    </label>
                </p>
                <?php
            }
            ?>
        </details>

        <br>
        <p class="description">Any issues related to the Click to Chat plugin? Please <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/support">contact us</a>.</p>

        </div>
        </li>
        </ul>

        

        <?php
    }


    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function options_sanitize( $input ) {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'not allowed to modify - please contact admin ' );
        }

        $new_input = array();

        foreach ($input as $key => $value) {

            if ( 'placeholder' == $key ) {
                $new_input[$key] = sanitize_textarea_field( $input[$key] );
            } elseif ( 'hook_v' == $key ) {
                $new_input[$key] = array_map( 'sanitize_text_field', $input[$key] );
            } elseif ( isset( $input[$key] ) ) {
                $new_input[$key] = sanitize_text_field( $input[$key] );
            }

        }
        
        do_action('ht_ctc_ah_admin_after_sanitize' );

        return $new_input;
    }





}

$ht_ctc_admin_other_settings = new HT_CTC_Admin_Other_Settings();

add_action('admin_menu', array($ht_ctc_admin_other_settings, 'menu') );
add_action('admin_init', array($ht_ctc_admin_other_settings, 'settings') );

endif; // END class_exists check