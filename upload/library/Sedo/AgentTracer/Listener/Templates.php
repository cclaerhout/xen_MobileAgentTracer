<?php
class Sedo_AgentTracer_Listener_Templates
{
	public static function listenhooks($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
	{
		switch ($hookName) 
		{
		case 'account_privacy_top':
			$options = XenForo_Application::get('options');
		
			if(!$options->sedo_at_preventracing)
			{
				break;
			}

			$mergedParams = array_merge($template->getParams(), $hookParams);
			$contents = $template->create('sedo_agent_account', $mergedParams) . $contents;

			break;

		case 'message_content':
			$options = XenForo_Application::get('options');
			$src = $template->getTemplateName();

			//Check which kind of integration is activated
			if(
			 	($src == 'conversation_view' && (!$options->sedo_at_auto_conversation || $options->sedo_at_auto_conversation_style != 'graphic'))
				OR 
				($src == 'thread_view' && (!$options->sedo_at_auto_thread || $options->sedo_at_auto_thread_style != 'graphic'))
			)
			{
				break;
			}

			if($options->sedo_at_auto_thread_style == 'graphic' || $options->sedo_at_auto_thread_style == 'graphic')
			{
				$mergedParams = array_merge($template->getParams(), $hookParams);
				$contents .= $template->create('sedo_agent', $mergedParams);
			}

			break;
		}
	}
}
//Zend_Debug::dump($hookParams);