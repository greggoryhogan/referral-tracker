<?php 
/*
 * Check if there is a referral variable in the url and if so then se save it to a cookie
 */
function check_for_referrer() {
    $variable = get_option('referral_variable');
    if (!empty($_GET[$variable])) {
        $expiration = get_option('cookie_expiration');
        setcookie('referral-tracker', $_GET[$variable], time() + $expiration, '/'); // 86400 = 1 day
    }
}
add_action('init', 'check_for_referrer');

/*
 * Shortcode to output the referral link
 */
add_shortcode( 'referral_link', 'referral_link' );
function referral_link( $atts ){
	extract( shortcode_atts(
		array(
            'link' => '',
            'text' => 'click here',
            'type' => '',
            'target' => '_self',
		),
		$atts
	) );

    $variable = get_option('referral_variable');
    if (!empty($_GET[$variable])) {
        $referral_id = $_GET[$variable];
    }  
    else if(isset($_COOKIE['referral-tracker'])){
        $referral_id = $_COOKIE['referral-tracker'];
    } else{
        $referral_id = get_option('default_referral_id');
    }

    $referral_link = str_replace('|*referral*|',$referral_id,$link);
    
    if($type == 'inline') {
        $output = $referral_link;
    } else {
        $class = 'referral-link';
        if($type == 'button') {
            $class .= ' ' . get_option('button_class');
        }
        
        $output = '<a href="'.$referral_link.'" target="'.$target.'" class="'.$class.'">'.$text.'</a>';
    }

	return $output;
}
?>