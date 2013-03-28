<?php
class Sedo_AgentTracer_Listener_InitDependencies
{
	public static function templateHelpers(XenForo_Dependencies_Abstract $dependencies, array $data)
	{
		XenForo_Template_Helper_Core::$helperCallbacks += array(
			'sedo_at_perms' => array('Sedo_AgentTracer_Helper_Template', 'checkPerms')
		);
	}
}
?>