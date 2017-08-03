<?php if (realpath (__FILE__) === realpath ($_SERVER["SCRIPT_FILENAME"]))
    exit ("Do not access this file directly.");
?>
<?php 
//TODO A dd Users array loop.
//var_dump($smsify_cf7_forms);
$counter = 0;
?>
<div class="wrap">
    <h2 class="nav-tab-wrapper">
        <a class="nav-tab nav-tab<?php $current_tab === 'home' ? _e('-active') : _e(''); ?>" href="<?php _e(add_query_arg(array('tab'=>'home'))) ?>">Contact Form 7</a>
        <a class="nav-tab nav-tab<?php $current_tab === 'custom' ? _e('-active') : _e(''); ?>" href="<?php _e(add_query_arg(array('tab'=>'custom'))) ?>">Custom</a>
    </h2>
    <?php if($current_tab === 'home') { ?>
        <h2><?php _e("Integrations") ?></h2>
        <p>To eliminate spam, please install reCAPTCHA plugin for Contact Form 7 under <strong>"Contact->Integration menu"</strong>. Make sure you have activated this plugin on <strong>SMSify->Settings</strong> page.</p>
        <p><strong>By default, the following message will be sent via the SMS when your Contact Form 7 is submitted successfully (You can customise this message in the Message column below):</strong><br>
        <?php _e($smsify_default_message) ?>.<br><br>
        <strong>Variables</strong>
        <br> 
        <?php _e($smsify_message_help); ?></p>
        <br>
        <strong>Help</strong>
        <p>For help and feature requests, please contact <a href="mailto:support@smsify.com.au">support@smsify.com.au</a></p>
        <form name="integration-form" id="integration-form" method="POST">
            <table class="wp-list-table widefat fixed">
                <tbody>
                    <tr>
                        <td scope="row"><strong>Contact 7 Forms</strong></td>
                        <td><strong>Status</strong></td>
                        <td><strong>Number to notify</strong></td>
                        <td><strong>Message</strong></td>
                    </tr>
                    <?php foreach($smsify_cf7_forms as $form) : $counter++ ?>
                        <tr class="alternate"<?php if($counter % 2 == 0) { echo ' style="background:#eee"'; } ?>>
                            <td scope="row"><?php _e($form->post_title) ?></label></td>
                            <td><?php _e($form->post_status) ?></td>
                            <td><input type="number" name="smsify_cf7_notify_<?php _e($form->ID) ?>" placeholder="Number to notify" maxlength="20" value="<?php _e($smsify_integration_mobiles['smsify_cf7_notify_'.$form->ID]) ?>"/></label></td>
                            <td><textarea name="smsify_cf7_message_<?php _e($form->ID) ?>" rows="3" cols="30" maxlength="150"><?php $smsify_integration_mobiles['smsify_cf7_message_'.$form->ID] ? _e($smsify_integration_mobiles['smsify_cf7_message_'.$form->ID]) : _e($smsify_default_message); ?></textarea></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <br>
            <input type="submit" name="smsify_integration_save" class="button button-primary action" value="SAVE" />
        </form>
    <?php } ?>
    <?php if($current_tab === 'custom') { ?>
        <h2><?php _e("Custom Integrations") ?></h2>
        <p>SMSify Custom Integration allows you to integrate SMS sending with any event in WordPress.  You will need access to your theme files so that your developer can trigger SMSify event that sends an SMS.</p>

        <p>To send an SMS programatically, you will need to trigger the <strong><i>smsify_send_sms_hook</i></strong> action and pass in <strong><i>message</i></strong> and <strong><i>send_to</i></strong> parameters into it.  See the code sample below:<br>
        <hr>
        <pre>
$args = new stdClass();
$args->message = "Hello from SMSify plugin";
$args->send_to = "NUMBER_IN_INTERNATIONAL_FORMAT"; //Make sure you use international number format WITHOUT the plus sign (+).
do_action('smsify_send_sms_hook', $args);
        </pre>
        <hr>
        </p>
        <strong style="color: #d54e21;">IMPORTANT</strong>
        <p>This function assumes that you have entered a valid SMSify API Key on the SMSify setting page.</p>
    <?php } ?>
</div>