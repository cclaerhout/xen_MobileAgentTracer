<?php
class Sedo_AgentTracer_Datawriter_ProfilePostComment extends XFCP_Sedo_AgentTracer_Datawriter_ProfilePostComment
{
	protected function _getFields()
	{
		$fields = parent::_getFields();
		$fields['xf_profile_post_comment']['sedo_agent'] = array('type' => self::TYPE_STRING, 'default' => '');

		return $fields;
	}

	protected function _preSave()
	{
		$options = XenForo_Application::get('options');
		
		if(	($this->_existingData && !$options->sedo_at_changeOnUpdate)
			|| self::checkSedoAgent() === false
			|| $this->get('user_id') != XenForo_Visitor::getUserId()
		)
		{
			return parent::_preSave();
		}

		$sedo_agent = Sedo_AgentTracer_Helper_Detector::get();

		$this->set('sedo_agent', $sedo_agent);

		return parent::_preSave();
	}
	
	private static function checkSedoAgent()
	{
		$options = XenForo_Application::get('options');
		$visitor = XenForo_Visitor::getInstance();
		
		if($options->sedo_at_preventracing && !$visitor->allow_sedo_agent)
		{
			return false;
		}
		
		return true;
	}
}
//Zend_Debug::dump($class);