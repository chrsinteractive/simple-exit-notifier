<?php

if (!defined('ABSPATH')) {
    exit;
}

class SEN_Frontend {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_footer', [$this, 'add_modal_html']);
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function enqueue_scripts() {
        wp_enqueue_script('sen-frontend', SEN_PLUGIN_URL . 'assets/js/frontend.js', ['jquery'], '1.0.2', true);
        wp_enqueue_style('sen-frontend', SEN_PLUGIN_URL . 'assets/css/frontend.css', [], SEN_VERSION);

        wp_localize_script('sen-frontend', 'simple_exit_notifier_data', [
            'exceptionClass' => get_option('simple_exit_notifier_exception_class', 'noexit'),
        ]);
    }

    /**
     * Add modal HTML to the footer.
     */
    public function add_modal_html() {
        $heading = esc_html(get_option('simple_exit_notifier_heading', 'Leaving Our Site'));
        $message = wp_kses_post(get_option('simple_exit_notifier_message', 'You are about to leave our website. Do you want to proceed?'));
        $proceed_text = esc_html(get_option('simple_exit_notifier_proceed_text', 'Proceed'));
        $cancel_text = esc_html(get_option('simple_exit_notifier_cancel_text', 'Cancel'));

        ?>
        <div id="simple-exit-notifier-modal" style="display: none;">
            <div class="simple-exit-notifier-overlay"></div>
            <div class="simple-exit-notifier-content">
                <div class="simple-exit-notifier-header">
                    <h2><?php echo $heading; ?></h2>
                </div>
                <div class="simple-exit-notifier-message">
                    <p><?php echo $message; ?></p>
                </div>
                <div class="simple-exit-notifier-actions">
                    <a id="simple-exit-notifier-proceed" href="#" target="_blank"><?php echo $proceed_text; ?></a>
                    <button id="simple-exit-notifier-cancel"><?php echo $cancel_text; ?></button>
                </div>
            </div>
        </div>
        <?php
    }
}
