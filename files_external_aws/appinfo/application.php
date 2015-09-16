<?php 
namespace OCA\Files_External_Aws\Appinfo;

use \OCP\AppFramework\App;
use OCP\IContainer;
use \OCA\Files_External_Aws\Controller\Usage;
use \OCA\Files_External_Aws\Quota;

class Application extends App {

    public function __construct(array $urlParms = array()){
        parent::__construct('files_external_aws', $urlParms);
    
        $container = $this->getContainer();
        
        $container->registerService('L10n', function($c){
            return $c->getServer()->getL10N('files_external_aws');
        });

        $container->registerService('Quota', function($c){
            return new Quota();
        });

        $container->registerService('UsageController', function($c){
            return new Usage(
                
                $c->query('AppName'),
                $c->query('Request'),
                $c->query('Quota')
            );
       });
    }
}
