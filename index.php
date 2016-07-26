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
	
	$time = wp_next_scheduled('kd_cron_hook');
	wp_unschedule_event($time, 'kd_cron_hook');
	
	if(!wp_next_scheduled('kd_cron_hook')){//if there is no other cron job scheduled
		wp_schedule_event(time(), 'two-minutes', 'kd_cron_hook', (array)$args)	;
	}
});

add_action('admin_menu', function(){
	add_options_page('Cron Settings', 'Cron Settings', 'manage_options', 'kd-cron', function(){
	//theme with manage options enabled can access this menu
	?>
    <div class="wrap">
    	<h2>Cron Events Scheduled</h2>
    </div>
    <?php	
	});
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