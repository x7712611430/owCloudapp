<?php
/**
 * ownCloud - files_external_aws
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author simon <simon.l@inwinstack.com>
 * @copyright simon 2015
 */

namespace OCA\Files_External_Aws\AppInfo;

use OCP\AppFramework\App;

$app = new App('files_external_aws');
$container = $app->getContainer();

\OCP\Util::addScript( 'files_external_aws', "script");
\OCP\Util::addStyle( 'files_external_aws', "style");
