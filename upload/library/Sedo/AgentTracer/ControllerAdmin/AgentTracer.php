<?php

class Sedo_AgentTracer_ControllerAdmin_AgentTracer extends XenForo_ControllerAdmin_Abstract
{
	public function actionRazEnable()
	{
		return $this->_razPrivacyField('1');		
	}

	public function actionRazDisable()
	{
		return $this->_razPrivacyField('0');
	}

	protected function _razPrivacyField($value)
	{
		if(!XenForo_Visitor::getInstance()->hasAdminPermission('canManageAgentTracer'))
		{
			throw $this->responseException($this->responseError(new XenForo_Phrase('sedo_at_no_admin_perms'), 404));
		}

		if ($this->isConfirmedPost())
		{
			$this->_getAgentTracerModel()->razUserPrivacy($value);

			return $this->responseRedirect(
				XenForo_ControllerResponse_Redirect::RESOURCE_UPDATED,
				XenForo_Link::buildAdminLink('options/list/sedo_agent_tracer'),
				new XenForo_Phrase('sedo_at_all_users_privacy_fields_have_been_updated') . " ($value)"
			);
		}
		else
		{
			$viewParams = array(
				'value' => $value
			);
			return $this->responseView('XenForo_ViewAdmin_Sedo_At_Raz_PrivacyFields', 'sedo_at_raz_privacy_confirm', $viewParams);
		}
	}

	protected function _getAgentTracerModel()
	{
		return $this->getModelFromCache('Sedo_AgentTracer_Model_AgentTracer');
	}		
}