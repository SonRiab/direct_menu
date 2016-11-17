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
script('direct_menu', 'admin');
?>
<div id="direct_menu" class="sub-section">
	<h2 class="inlineblock"><?php p($l->t('Direct Menu')); ?></h2>
	<div id="direct_menu_settings_msg" class="msg success inlineblock" style="display: none;">Saved</div>
	<?php if (\OCP\App::isEnabled('theming') === false) { ?>
	<p>
		<?php p($_['errorMessage']) ?>
	</p>
	<?php } else { ?>
	<div>
		<input id="direct_menu-hideAppName" type="checkbox" class="checkbox" <?php if($_['hideAppName']) p('checked') ?> />
		<label for="direct_menu-hideAppName"><?php p($l->t('Hide App Name')) ?></label>
	</div>
	<?php } ?>
</div>
