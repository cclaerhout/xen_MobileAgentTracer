<?php
class Sedo_AgentTracer_Helper_Detector
{
	public static function get()
	{
		//Check if mobile
		if(class_exists('Sedo_DetectBrowser_Listener_Visitor'))
		{
			//External addon
			$visitor = XenForo_Visitor::getInstance();

			if(!$visitor->getBrowser['isMobile'])
			{
				return;
			}
		
			//Tablets
			if($visitor->getBrowser['isTablet'])
			{
	      			foreach ($visitor->getBrowser['mobile']['tablets'] as $key => $value)
	      			{
	      				if($key != 'isGenericTablet' && $value != false)
	      				{
	      					return $key;
	      				}
	      			}
	      			
				return 'isTablet';
			}

      			//Phones 
    			foreach ($visitor->getBrowser['mobile']['phones'] as $key => $value)
    			{
    				if($key != 'isGenericPhone' && $value != false)
    				{
    					return $key;
    				}
    			}
    			
			return 'isMobile';
		}

		//XenForo
		if(!XenForo_Visitor::isBrowsingWith('mobile'))
		{
			return;
		}
			
		return 'isMobile';
	}
}
//Zend_Debug::dump($class);