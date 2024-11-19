<?php

function validate_email_domain($result, $tag) {
    $blocked_domains = ['avafin.pl', 'avafin.com.pl', 'avafin.mx', 'avafin.com.mx', 'avafin.lv'];
    
    if ($tag->name == 'test-email') {
        $email = isset($_POST['test-email']) ? sanitize_email($_POST['test-email']) : '';

        $domain = substr(strrchr($email, "@"), 1);

        foreach ($blocked_domains as $blocked_domain) {
            if (strpos($domain, $blocked_domain) !== false) {
                $result->invalidate($tag, "Pracowników zapraszamy od zaplecza");
                break;
            }
        }
    }

    return $result;
}
add_filter('wpcf7_validate_email*', 'validate_email_domain', 10, 2);
