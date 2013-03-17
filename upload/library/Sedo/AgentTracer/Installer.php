<?php
class Sedo_AgentTracer_Installer
{
	public static function install($addon)
	{
	        $db = XenForo_Application::get('db');

		if(empty($addon))
		{
			$db->query("ALTER TABLE xf_conversation_message ADD sedo_agent varchar(50) NOT NULL");
			$db->query("ALTER TABLE xf_post ADD sedo_agent varchar(50) NOT NULL");
			$db->query("ALTER TABLE xf_profile_post ADD sedo_agent varchar(50) NOT NULL");			
			$db->query("ALTER TABLE xf_profile_post_comment ADD sedo_agent varchar(50) NOT NULL");
		}
		
		if(empty($addon) || $addon['version_id'] < 1)
		{
			 $db->query("ALTER TABLE `xf_user_privacy` ADD `allow_sedo_agent` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '1'");
		}
	}
	
	public static function uninstall()
	{
	        $db = XenForo_Application::get('db');

			$db->query("ALTER TABLE xf_conversation_message DROP sedo_agent");
			$db->query("ALTER TABLE xf_post DROP sedo_agent");
			$db->query("ALTER TABLE xf_profile_post DROP sedo_agent");
			$db->query("ALTER TABLE xf_profile_post_comment DROP sedo_agent");
			$db->query("ALTER TABLE xf_user_privacy DROP allow_sedo_agent");						
	}	
}