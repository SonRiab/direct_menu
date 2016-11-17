<?php
/**
 * @copyright Copyright (c) 2016 Rene Jablonski <rene@vnull.de>
 *
 * @author Rene Jablonski <rene@vnull.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OCA\DirectMenu;

use OCP\IConfig;
	
class DirectMenu {
	/** @var IConfig */
	private $config;
	
	/** @var boolean */
	private $isAppNameHidden;
	
	public function __construct(IConfig $config) {
		$this->config = $config;
		$isAppNameHidden = $this->config->getAppValue('direct_menu', 'hideAppName', 'no') === 'yes';
	}
	
	public function isAppNameHidden() {
		return $isAppNameHidden;
	}
	
	public function updateHideAppName($value) {
		$this->config->setAppValue(
			'direct_menu',
			'hideAppName',
			$value === 'yes' ? 'yes' : 'no'
		);
		$isAppNameHidden = $value ? 'yes' : 'no';
	}
}
?>