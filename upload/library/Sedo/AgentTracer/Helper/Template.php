<?php
class Sedo_AgentTracer_Helper_Template
{
	public static function checkPerms()
	{
		$visitor = XenForo_Visitor::getInstance();
		return XenForo_Permission::hasPermission($visitor['permissions'], 'sedo_mobile_agent_tracer', 'nview');
	}
}
