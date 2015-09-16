<?php
namespace OCA\Files_External_Aws\Controller;

use OCP\AppFramework\Http\Templateresponse;
use OCP\AppFramework\Controller;
use OCP\IRequest;
use OCP\AppFramework\Http\DataResponse;

use OCA\Files_External_Aws\Quota;

class Usage extends Controller{
    
    protected $quota;


    public function __construct($AppName, IRequest $request, Quota $quota) {
        parent::__construct($AppName, $request);
        $this->quota = $quota;
    }
    
    public function getSize($user = ''){
        
        return new DataResponse($this->quota->getQuota($user));
    }

}
?>
