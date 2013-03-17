<?php
class Sedo_AgentTracer_Datawriter_User extends XFCP_Sedo_AgentTracer_Datawriter_User
{
	protected function _getFields()
	{
		$parent = parent::_getFields();
		
		$parent['xf_user_privacy']['allow_sedo_agent'] = array(
				'type' => self::TYPE_BOOLEAN, 
				'default' => 1
		);

		return $parent;
	}

	protected function _preSave()
	{
		$options = XenForo_Application::get('options');

		if(!$options->sedo_at_preventracing)
		{
			return parent::_preSave();
		}	
				
	        $_input = new XenForo_Input($_REQUEST);
		$sedo_agent = $_input->filterSingle('allow_sedo_agent', XenForo_Input::UINT);

		if($_input->inRequest('allow_sedo_agent'))
		{
			//The wrapped conditionnal prevents the field 'allow_sedo_agent' to be modified outside the page 'user'
			//Fixes a problem with profile posts
			$this->set('allow_sedo_agent', $sedo_agent);
		}
		
		return parent::_preSave();
	}
}

