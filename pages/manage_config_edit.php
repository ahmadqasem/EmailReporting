<?php
auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );


$f_gpc = array(
	'mail_add_bug_reports'			=> gpc_get_bool( 'mail_add_bug_reports' ),
	'mail_add_bugnotes'				=> gpc_get_bool( 'mail_add_bugnotes' ),
	'mail_add_complete_email'		=> gpc_get_bool( 'mail_add_complete_email' ),
	'mail_auto_signup'				=> gpc_get_bool( 'mail_auto_signup' ),
	'mail_debug'					=> gpc_get_bool( 'mail_debug' ),
	'mail_debug_directory'			=> trim( str_replace( '\\', '/', gpc_get_string( 'mail_debug_directory' ) ), '/ ' ),
	'mail_delete'					=> gpc_get_bool( 'mail_delete' ),
	'mail_email_receive_own'		=> gpc_get_string( 'mail_email_receive_own' ),
	'mail_encoding'					=> gpc_get_string( 'mail_encoding' ),
	'mail_fallback_mail_reporter'	=> gpc_get_bool( 'mail_fallback_mail_reporter' ),
	'mail_fetch_max'				=> gpc_get_int( 'mail_fetch_max' ),
	'mail_remove_mantis_email'		=> gpc_get_bool( 'mail_remove_mantis_email' ),
	'mail_nodescription'			=> gpc_get_string( 'mail_nodescription' ),
	'mail_nosubject'				=> gpc_get_string( 'mail_nosubject' ),
	'mail_parse_html'				=> gpc_get_bool( 'mail_parse_html' ),
	'mail_parse_mime'				=> gpc_get_bool( 'mail_parse_mime' ),
	'mail_remove_replies'			=> gpc_get_bool( 'mail_remove_replies' ),
	'mail_remove_replies_after'		=> gpc_get_string( 'mail_remove_replies_after' ),
	'mail_removed_reply_text'		=> gpc_get_string( 'mail_removed_reply_text' ),
	'mail_reporter_id'				=> gpc_get_int( 'mail_reporter_id' ),
	'mail_save_from'				=> gpc_get_bool( 'mail_save_from' ),
	'mail_secured_script'			=> gpc_get_bool( 'mail_secured_script' ),
	'mail_tmp_directory'			=> trim( str_replace( '\\', '/', gpc_get_string( 'mail_tmp_directory' ) ), '/ ' ),
	'mail_use_bug_priority'			=> gpc_get_bool( 'mail_use_bug_priority' ),
	'mail_use_reporter'				=> gpc_get_bool( 'mail_use_reporter' ),
);

$f_mail_bug_priority				= gpc_get_string( 'mail_bug_priority' );

foreach ( $f_gpc AS $t_key => $t_value )
{
	if( plugin_config_get( $t_key ) != $t_value )
	{
		plugin_config_set( $t_key, $t_value );
	}
}

$t_mail_bug_priority = @eval( 'return ' . $f_mail_bug_priority . ';' );
if( is_array( $t_mail_bug_priority ) )
{
	if ( plugin_config_get( 'mail_bug_priority' ) != $t_mail_bug_priority )	{
		plugin_config_set( 'mail_bug_priority', $t_mail_bug_priority );
	}
}
else
{
	html_page_top( plugin_lang_get( 'title' ) );

	echo '<br /><div class="center">';
	echo plugin_lang_get( 'mail_bug_priority_array_failure' ) . ' ';
	print_bracket_link( plugin_page( 'manage_config', TRUE ), lang_get( 'proceed' ) );
	echo '</div>';

	$t_notsuccesfull = TRUE;

	html_page_bottom( __FILE__ );
}

if ( !isset( $t_notsuccesfull ) )
{
	print_successful_redirect( plugin_page( 'manage_config', TRUE ) );
}