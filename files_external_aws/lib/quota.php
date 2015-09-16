<?php

namespace OCA\Files_External_Aws;

use \OC\Files\Storage\AmazonS3;
use \OC;

class Quota{

    public static function getQuota($newUser){
        // make sure that you are using correct region (where the bucket is) to get new Amazon S3 client
        //$client = \Aws\S3\S3Client::factory(array('region' => $region));
        //$path = \OC::$SERVERROOT;
        $path = \OC::getRootFolder();
        $str = file_get_contents($path.'data/mount.json');
        $json = json_decode($str, true);
        $result = array();
        
        if($newUser != ''){
            $newmountData = $json['user'][$newUser];
            return $this->getSize($newUser, $newmountData);
        }
        
        else{
            foreach($json['user'] as $username => $mountData) {
                $this->getSize($username, $mountData);
                array_push($result, $node);
            }

            return $result;
        }
    }

    public function getSize($username, $mountData) {
        $keys = array_keys($mountData);
        $bucket = $mountData[$keys[0]]['options']['bucket'];
        $params = array('key'=> \OCP\config::getSystemValue('S3key'), 'secret'=> \OCP\config::getSystemValue('S3secret'), 'bucket'=>$bucket, 'use_ssl'=>'false', 'hostname'=>'', 'port'=>'', 'region'=>'' , 'use_path_style'=>'');
        $amazon = new AmazonS3($params);
        $client = $amazon->getConnection(); 
    
        // check if bucket exists
        if (!$client->doesBucketExist($bucket, $accept403 = true)) {
            return false;
        }
        // get bucket objects
        $objects = $client->getBucket(array('Bucket' => $bucket));

        $total_size_bytes = 0;
        $contents = $objects['Contents'];

        // iterate through all contents to get total size
        foreach ($contents as $key => $value) {
            $total_size_bytes += $value['Size'];
        }

        //$total_size_gb = $total_size_bytes / 1024 / 1024 / 1024;
        $total_size = \OC_Helper::humanFileSize($total_size_bytes);

        $node = array('username' => $username, 'usage' => $total_size);
        return $node;
    }
}
