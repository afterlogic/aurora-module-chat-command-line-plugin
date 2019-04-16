<?php
/**
 * This code is licensed under AGPLv3 license or Afterlogic Software License
 * if commercial version of the product was purchased.
 * For full statements of the licenses see LICENSE-AFTERLOGIC and LICENSE-AGPL3 files.
 */

namespace Aurora\Modules\ChatCommandLinePlugin;

/**
 * @license https://www.gnu.org/licenses/agpl-3.0.html AGPL-3.0
 * @license https://afterlogic.com/products/common-licensing Afterlogic Software License
 * @copyright Copyright (c) 2019, Afterlogic Corp.
 *
 * @package Modules
 */
class Module extends \Aurora\System\Module\AbstractModule
{
	const PREFIX = '/';
	const COMMAND_HELP = 'help';
	const COMMAND_HELP_SHORT = '?';
	const COMMAND_DATE = 'date';
	
	public $oApiCommandManager = null;
	
	public function init()
	{
		$this->oApiCommandManager = new Manager($this);
		$this->subscribeEvent('Chat::CreatePost::after', array($this, 'onCreatePost'));
		
	}
	
	public function onCreatePost(&$aArgs, &$mResult)
	{
		if (isset($aArgs['Text']) && $aArgs['Text'][0] === self::PREFIX)
		{
			$sCommandResponce = $this->ExecuteCommand(substr($aArgs['Text'], 1));
			if ($sCommandResponce)
			{
				$oDate = new \DateTime();
				$oDate->setTimezone(new \DateTimeZone('UTC'));
				$oChatModule = \Aurora\System\Api::GetModule('Chat');
				$oChatModule->oApiPostsManager->CreatePost(
					isset($aArgs['UserId']) ? $aArgs['UserId'] : 0,
					$sCommandResponce,
					$oDate->getTimestamp(),
					$aArgs['ChannelUUID'],
					true);
			}
		}
	}
	
	protected function ExecuteCommand($sCommand)
	{
		$sResult = '';
		switch (trim($sCommand))
		{
			case self::COMMAND_HELP:
			case self::COMMAND_HELP_SHORT:
				$sResult = $this->oApiCommandManager->getHelp();
				break;
			case self::COMMAND_DATE:
				$sResult = $this->oApiCommandManager->getDate();
				break;
		}
		return $sResult;
	}
}
