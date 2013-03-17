<?php
class Sedo_AgentTracer_Listener_Datawriter
{
	public static function listen($class, array &$extend)
	{
		if($class == 'XenForo_DataWriter_ConversationMessage')
		{
			$extend[] = 'Sedo_AgentTracer_Datawriter_ConversationMessage';
		}

		if ($class == 'XenForo_DataWriter_DiscussionMessage_Post')
        	{
			$extend[] = 'Sedo_AgentTracer_Datawriter_DiscussionMessage';
		}
		
		if($class == 'XenForo_DataWriter_DiscussionMessage_ProfilePost')
		{
			$extend[] = 'Sedo_AgentTracer_Datawriter_ProfilePost';
		}
		
		if($class == 'XenForo_DataWriter_ProfilePostComment')
		{
			$extend[] = 'Sedo_AgentTracer_Datawriter_ProfilePostComment';		
		}

		if ($class == 'XenForo_DataWriter_User')
		{
			$extend[] = 'Sedo_AgentTracer_Datawriter_User';
		}
	}
}
//Zend_Debug::dump($class);