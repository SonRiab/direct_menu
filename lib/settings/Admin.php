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

namespace OCA\DirectMenu\Settings;

//use OCA\Direct_menu\AppInfo\Application;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IL10N;
use OCP\Settings\ISettings;

class Admin implements ISettings {

	/** @var IL10N */
	private $l10n;

	/** @var string */
	private $appName;

	/** @var IConfig */
	private $config;

	/**
	 * @param string $appName
	 * @param IL10N $l
	 * @param IConfig $$config
	 */
	public function __construct($appName, IL10N $l, IConfig $config) {
		$this->appName = $appName;
		$this->l10n = $l;
		$this->config = $config;
	}

	/**
	 * @return TemplateResponse
	 */
	public function getForm() {
		$parameters = [
			'hideAppName' => $this->config->getAppValue('direct_menu', 'hideAppName', 'no') === 'yes',
		];

		return new TemplateResponse('direct_menu', 'admin', $parameters, 'blank');
	}

	/**
	 * @return string the section ID, e.g. 'sharing'
	 */
	public function getSection() {
		return 'theming';
	}

	/**
	 * @return int whether the form should be rather on the top or bottom of
	 * the admin section. The forms are arranged in ascending order of the
	 * priority values. It is required to return a value between 0 and 100.
	 *
	 * E.g.: 70
	 */
	public function getPriority() {
		return 50;
	}

}
