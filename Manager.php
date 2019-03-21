<?php
/**
 * This code is licensed under AGPLv3 license or AfterLogic Software License
 * if commercial version of the product was purchased.
 * For full statements of the licenses see LICENSE-AFTERLOGIC and LICENSE-AGPL3 files.
 */

namespace Aurora\Modules\ChatCommandLinePlugin;

/**
 * @license https://www.gnu.org/licenses/agpl-3.0.html AGPL-3.0
 * @license https://afterlogic.com/products/common-licensing AfterLogic Software License
 * @copyright Copyright (c) 2019, Afterlogic Corp.
 */ 
class Manager extends \Aurora\System\Managers\AbstractManager
{	
	/**
	 * 
	 * @param \Aurora\System\Module\AbstractModule $oModule
	 */
	public function __construct(\Aurora\System\Module\AbstractModule $oModule = null)
	{
		parent::__construct($oModule);
	}
	
	public function getHelp()
	{
		return $this->GetModule()->i18N('INFO_HELP');
	}
	
	public function getDate()
	{
		$sDate = date("Y-m-d");
		return $sDate;
	}
}
