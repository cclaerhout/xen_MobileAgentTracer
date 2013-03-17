<?php
class Sedo_AgentTracer_Datawriter_DiscussionMessage extends XFCP_Sedo_AgentTracer_Datawriter_DiscussionMessage
{
	protected function _getCommonFields()
	{
		$fields = parent::_getCommonFields();
		$structure = $this->_messageDefinition->getMessageStructure();
		$fields[$structure['table']]['sedo_agent'] = array('type' => self::TYPE_STRING, 'default' => '');

		return $fields;
	}

	protected function _messagePreSave()
	{
		$options = XenForo_Application::get('options');

		if(	($this->_existingData && !$options->sedo_at_changeOnUpdate)
			|| self::checkSedoAgent() === false
			|| $this->get('likes') != NULL
			|| $this->get('user_id') != XenForo_Visitor::getUserId()
		)
		{
			return parent::_messagePreSave();
		}

		$sedo_agent = Sedo_AgentTracer_Helper_Detector::get();
		$this->set('sedo_agent', $sedo_agent);

		return parent::_messagePreSave();
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