<?php
/**
 * @copyright Copyright (c) 2016 Julius Härtl <jus@bitgrid.net>
 *
 * @author Julius Härtl <jus@bitgrid.net>
 * @author Rene Jablonski <rene@vnull.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\DirectMenu\Controller;
use OCA\DirectMenu\DirectMenu;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataDownloadResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Utility\ITimeFactory;
use OCP\IRequest;
use OCP\IConfig;
use OCP\IL10N;

class AppController extends \OCP\AppFramework\Controller {
	
	/** @var IConfig */
	private $config;
	
	/** @var ITimeFactory */
	private $timeFactory;
	
	/** @var IL10N */
	private $l10n;

	/** @var DirectMenu */
	private $directMenu;

	public function __construct($appName, IRequest $request, ITimeFactory $timeFactory, IConfig $config, IL10N $l, DirectMenu $directMenu) {
		parent::__construct($appName, $request);
		$this->timeFactory = $timeFactory;
		$this->config = $config;
		$this->l10n = $l;
		$this->directMenu = $directMenu;
	}

	/**
	 * @NoCSRFRequired
	 * @PublicPage
	 *
	 * @return DataDownloadResponse
	 */
	public function stylesheet() {
		$inverted = false;
		if(\OCP\App::isEnabled('theming') && class_exists('\OCA\Theming\Util')) {
			$color = \OC::$server->getThemingDefaults()->getMailHeaderColor();
			$util = new \OCA\Theming\Util();
			$inverted = $util->invertTextColor($color);
		}

		$navigation = \OC::$server->getNavigationManager()->getAll();
		$navigationCount = count($navigation);

		// 250px for icon/appname
		// 120px for user menu + 1 icon spacing
		$width = $navigationCount*50+250+170;

		$params = [
			'width' => $width,
			'inverted' => $inverted,
			'hideAppName' => $this->config->getAppValue('direct_menu', 'hideAppName', 'no') === 'yes',
		];
		$template = new TemplateResponse('direct_menu', 'direct_menu', $params, 'blank');
		$response = new DataDownloadResponse($template->render(), 'style.css', 'text/css');
		$response->addHeader('Expires', date(\DateTime::RFC2822, $this->timeFactory->getTime()));
		$response->addHeader('Pragma', 'cache');
		$response->cacheFor(3600);
		return $response;
	}
	
	public function setHideAppName($value) {
		$this->directMenu->updateHideAppName($value);
		return new DataResponse(
			[
				'data' =>
					[
						'message' => $this->l10n->t('Saved')
					],
				'status' => 'success'
			]
		);
	}

}