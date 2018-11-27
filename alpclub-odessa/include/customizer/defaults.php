<?php
function _get_aco_theme_default_options() : array {	
	$defaults = [];

	$defaults['member_count']                  = 0;		
	$defaults['show_breadcrumb']               = true;
	$defaults['maintenance_mode']              = false;
/*	
	$defaults['ga_active']                    = false;
	$defaults['ga_tracking_id']               = 'UA-116898406-1';
	$defaults['ga_in_footer']                 = false;	
	$defaults['ga_async']                     = true;
*/	
	// Address.
	$defaults['company_name']     = '';
	$defaults['street_address_1'] = '';
	$defaults['street_address_2'] = '';
	$defaults['city']          	  = '';
	$defaults['postal_index']     = '';
	$defaults['country']          = '';

	// Contact.
	$defaults['phone_1']          = '380487256913';
	$defaults['phone_2']          = '380487227360';
	$defaults['phone_3']          = '';
	$defaults['fax']          	  = '';
	$defaults['email_1']          = 'info@alp.od.ua';
	$defaults['email_2']          = '';		
	
	$defaults['skype']            = '';	
	$defaults['whatsapp']         = '';	
	$defaults['tg']               = '';	
	$defaults['viber']            = '';	
	
	$defaults['url']              = 'https://travel.alp.od.ua';	

	//Opening time
	$defaults['opening_time_1']   = 'ПН, ВТ, ЧТ, ПТ 10:00-18:00';
	$defaults['opening_time_2']   = 'СР 10:00-21:00';
	$defaults['opening_time_3']   = 'СБ, ВС выходной';
	$defaults['opening_time_4']   = '';		
	$defaults['opening_time_5']   = '';		
	$defaults['opening_time_6']   = '';		
	$defaults['opening_time_7']   = '';	
	
	return $defaults;
}