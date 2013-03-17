<?php

class Sedo_AgentTracer_Route_PrefixAdmin_AgentTracer implements XenForo_Route_Interface
{
	public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
	{
		$action = $router->resolveActionWithStringParam($routePath, $request, 'data');

		return $router->getRouteMatch('Sedo_AgentTracer_ControllerAdmin_AgentTracer', $action);
	}

	public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
	{
		return XenForo_Link::buildBasicLinkWithStringParam($outputPrefix, $action, $extension, $data, 'data');
	}
}