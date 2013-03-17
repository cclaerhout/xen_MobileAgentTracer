<?php
class Sedo_AgentTracer_ControllerPublic_Account extends XFCP_Sedo_AgentTracer_ControllerPublic_Account
{
	public function actionRaz_mobileinfo()
	{
		$this->_checkCsrfFromToken($this->_input->filterSingle('_xfToken', XenForo_Input::STRING));

		$id = XenForo_Visitor::getUserId();
		$options = XenForo_Application::get('options');

		if (empty($id) || !$options->sedo_at_allowraz || !$options->sedo_at_preventracing)
		{
			return $this->responseError(new XenForo_Phrase('sedo_at_error_action_not_allowed'), 404);
		}

		if ($this->isConfirmedPost())
		{
			if(!empty($id))
			{
				$db = XenForo_Application::get('db');
				
				$db->query("UPDATE xf_post SET sedo_agent = '' WHERE user_id =$id");
				$db->query("UPDATE xf_conversation_message SET sedo_agent = '' WHERE user_id =$id");
				$db->query("UPDATE xf_profile_post_comment SET sedo_agent = '' WHERE user_id =$id");			
				$db->query("UPDATE xf_profile_post SET sedo_agent = '' WHERE user_id =$id");
			}

			return $this->responseRedirect(
				XenForo_ControllerResponse_Redirect::SUCCESS,
				XenForo_Link::buildPublicLink('account/privacy')
			);
		}
		else
		{
			$viewParams = array();

			return $this->responseView('Sedo_AgentTracer_ViewViewPublic_Account_RazMobileinfo', 'sedo_agent_account_raz', $viewParams);
		}
	}
}
//Zend_Debug::dump($class);