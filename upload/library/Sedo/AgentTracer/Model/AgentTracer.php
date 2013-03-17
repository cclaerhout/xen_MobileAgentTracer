<?php

class Sedo_AgentTracer_Model_AgentTracer extends XenForo_Model
{
	/**
	* Raz Users Privacy Fields
	*/
	public function razUserPrivacy($value)
	{
		if (!$this->_getDb()->fetchRow("SHOW COLUMNS FROM xf_user_privacy WHERE Field = ?", 'allow_sedo_agent') || !in_array($value, array(0, 1)) )
		{
			$this->error(new XenForo_Phrase('sedo_at_error_the_field_doesnt_exist_or_value_is_incorrect'));
			return false;
		}

		return $this->_getDb()->query("UPDATE xf_user_privacy SET allow_sedo_agent = '$value'");
	}
}