<?php

class Sedo_AgentTracer_Listener_Preloader
{
	public static function preloader($templateName, array &$params, XenForo_Template_Abstract $template)
	{
		if (in_array($templateName, array('conversation_view', 'thread_view')))
		{
			$template->preloadTemplate('sedo_agent');
		}
		
		if($templateName == 'account_privacy')
		{
			$template->preloadTemplate('sedo_agent_account');
		}
	}
}