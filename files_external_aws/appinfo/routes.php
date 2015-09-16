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

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Files_External_Aws\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */

namespace OCA\Files_External_Aws\AppInfo;

$application = new Application();
$application->registerRoutes($this,[
    'routes' => [
       ['name' => 'Usage#getSize', 'url' => '/getSize', 'verb' => 'GET']
    ]
]);
