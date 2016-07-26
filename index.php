<?php
/*
Plugin Name: KD Cron
Plugin URI: http://bgwebagency.com
Version: 1.0
Author: Kiran Dash
Plugin URI: http://bgwebagency.com
*/

//wp_schedule_event($time, $recurrence, $hook, (array)$args)

add_action('init', function(){//wordpress is fully loaded but has not sent any header yet
	if(!wp_next_scheduled('kd_cron_hook')){//if there is no other cron job scheduled
		wp_schedule_event(time(), 'two-minutes', 'kd_cron_hook', (array)$args)	;
	}
});

add_action('kd_cron_hook', function(){
	$str = time();
	wp_mail('kiran@xhtmlchamps.com', 'Scheduled with WP_Cron!', "This email was sent at $str.");
});

// Custom cron scheduling
add_filter('cron_schedules', function($schedules){
	$schedules['two-minutes'] = array(
		'interval'=>120,
		'display'=>'Every Two Minutes'
	);
	return $schedules;
});
?>