<?php
class Sedo_AgentTracer_Listener_ControllerPublic
{
	public static function listen($class, array &$extend)
	{
		if($class == 'XenForo_ControllerPublic_Account')
		{
			$extend[] = 'Sedo_AgentTracer_ControllerPublic_Account';
		}
	}
}
//Zend_Debug::dump($class);