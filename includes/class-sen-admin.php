<?php

if (!defined('ABSPATH')) {
    exit;
}

class SEN_Admin {

    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    /**
     * Register plugin settings.
     */
    public function register_settings() {
        register_setting('sen_settings_group', 'simple_exit_notifier_heading', ['sanitize_callback' => 'sanitize_text_field']);
        register_setting('sen_settings_group', 'simple_exit_notifier_message', ['sanitize_callback' => 'wp_kses_post']);
        register_setting('sen_settings_group', 'simple_exit_notifier_proceed_text', ['sanitize_callback' => 'sanitize_text_field']);
        register_setting('sen_settings_group', 'simple_exit_notifier_cancel_text', ['sanitize_callback' => 'sanitize_text_field']);
        register_setting('sen_settings_group', 'simple_exit_notifier_exception_class', ['sanitize_callback' => 'sanitize_text_field']);
    }

    /**
     * Add plugin settings page to the admin menu.
     */
    public function add_admin_menu() {
        add_options_page(
            __('Simple Exit Notifier', 'chrssen'),
            __('Exit Notifier', 'chrssen'),
            'manage_options',
            'simple-exit-notifier',
            [$this, 'render_settings_page']
        );
    }

    /**
     * Render the settings page.
     */
    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Simple Exit Notifier', 'chrssen'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('sen_settings_group');
                do_settings_sections('sen_settings_group');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="simple_exit_notifier_heading"><?php esc_html_e('Popup Heading', 'chrssen'); ?></label></th>
                        <td><input type="text" id="simple_exit_notifier_heading" name="simple_exit_notifier_heading" value="<?php echo esc_attr(get_option('simple_exit_notifier_heading', 'Leaving Our Site')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="simple_exit_notifier_message"><?php esc_html_e('Popup Message', 'chrssen'); ?></label></th>
                        <td><textarea id="simple_exit_notifier_message" name="simple_exit_notifier_message" rows="5" class="large-text"><?php echo esc_textarea(get_option('simple_exit_notifier_message', 'You are about to leave our website. Do you want to proceed?')); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="simple_exit_notifier_proceed_text"><?php esc_html_e('Proceed Button Text', 'chrssen'); ?></label></th>
                        <td><input type="text" id="simple_exit_notifier_proceed_text" name="simple_exit_notifier_proceed_text" value="<?php echo esc_attr(get_option('simple_exit_notifier_proceed_text', 'Proceed')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="simple_exit_notifier_cancel_text"><?php esc_html_e('Cancel Button Text', 'chrssen'); ?></label></th>
                        <td><input type="text" id="simple_exit_notifier_cancel_text" name="simple_exit_notifier_cancel_text" value="<?php echo esc_attr(get_option('simple_exit_notifier_cancel_text', 'Cancel')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="simple_exit_notifier_exception_class"><?php esc_html_e('Exception Class', 'chrssen'); ?></label></th>
                        <td>
                            <input type="text" id="simple_exit_notifier_exception_class" name="simple_exit_notifier_exception_class" value="<?php echo esc_attr(get_option('simple_exit_notifier_exception_class', 'noexit')); ?>" class="regular-text" />
                            <p class="description"><?php esc_html_e('Add a CSS class to exclude certain links from showing the exit popup (e.g., "noexit").', 'chrssen'); ?></p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}
