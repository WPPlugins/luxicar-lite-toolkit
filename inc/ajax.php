<?php
// Send mail
if (!function_exists('luxicar_ajax_send_contact_widget_1')) {

    function luxicar_ajax_send_contact_widget_1() {

        if ( ! check_ajax_referer('luxicar_send_contact_widget_1', 'ajax_nonce_luxicar_send_contact_widget_1', false) ) {
            die( __('Oops! errors occured.', 'luxicar') );
        }

        foreach ($_POST as $key => $value) {
            if (ini_get('magic_quotes_gpc')) {
                $_POST[$key] = stripslashes($_POST[$key]);
            }
            $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
        }

        $name    = $_POST["name"];
        $email   = $_POST["email"];
        $subject = $_POST['subject'];
        $message = $_POST["message"];

        $message_body = "Name: {$name}" . PHP_EOL ."Subject: {$subject}". PHP_EOL. "Message: {$message}";

        $to = get_bloginfo('admin_email');

        if ( isset( $_POST["subject"] ) && $_POST["subject"] != '' ) {
            $subject = "Contact Form: $name - {$_POST['subject']}";
        } else {
            $subject = "Contact Form: $name";
        }

        $headers[] = 'From: ' . $name . ' <' . $email . '>';
        $headers[] = 'Cc: ' . $name . ' <' . $email . '>';

        $result = __('Oops! errors occured.', 'luxicar');

        if (wp_mail($to, $subject, $message_body, $headers)) {
            $result = __('Success! Your email has been sent.', 'luxicar');
        }

        echo json_encode($result);
        die();
    }

    add_action('wp_ajax_luxicar_send_contact_widget_1', 'luxicar_ajax_send_contact_widget_1');
    add_action('wp_ajax_nopriv_luxicar_send_contact_widget_1', 'luxicar_ajax_send_contact_widget_1');
}