<?php 
/*
 * jQuery File Download Plugin PHP Class 1.1.0
* https://#
*
* Copyright 2010, SunChen
* https://#
*
* Licensed under the MIT license:
* http://www.opensource.org/licenses/MIT
*/

class DownloadHandler
{
    protected $options;

    function __construct($options = null, $initialize = true) {
        $this->options = array(
            'script_url' => $this->get_full_url().'/',
            'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/files/',
            'upload_url' => $this->get_full_url().'/files/',
            'user_dirs' => false,
            'mkdir_mode' => 0755,
            'param_name' => 'files',
 
            'download_via_php' => false,
            // Read files in chunks to avoid memory limits when download_via_php
            // is enabled, set to 0 to disable chunked reading of files:
            'readfile_chunk_size' => 10 * 1024 * 1024, // 10 MiB
            // Defines which files can be displayed inline when downloaded:
            'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Defines which files (based on their names) are accepted for upload:
            'accept_file_types' => '/.+$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => null,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
            'max_number_of_files' => null,
            // Defines which files are handled as image files:
            'image_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Use exif_imagetype on all files to correct file extensions:
            'correct_image_extensions' => false,
            // Image resolution restrictions:
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,


            'image_versions' => array(
                // The empty image version key defines options for the original image:
                '' => array(
                    // Automatically rotate images based on EXIF meta data:
                    'auto_orient' => true
                ),
                
                'thumbnail' => array(
                    
                    'max_width' => 80,
                    'max_height' => 80
                )
            )
        );
        if ($options) {
            $this->options = $options + $this->options;
        }
        if ($initialize) {
            $this->initialize();
        }
    }
    protected function initialize() {
        switch ($this->get_server_var('REQUEST_METHOD')) {
            case 'POST':
                $this->download();
                break;
            default:
                $this->header('HTTP/1.1 405 Method Not Allowed');
        }
    }
    protected function get_server_var($id) {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }
    
    protected function get_user_id() {
        @session_start();
        return session_id();
    }

    protected function get_user_path() {
        if ($this->options['user_dirs']) {
            return $this->get_user_id().'/';
        }
        return '';
    }
    
    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
        !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        return
        ($https ? 'https://' : 'http://').
        (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
                $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
                substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    protected function get_upload_path($file_name = null, $version = null) {
        $file_name = $file_name ? $file_name : '';
        if (empty($version)) {
            $version_path = '';
        } else {
            $version_dir = @$this->options['image_versions'][$version]['upload_dir'];
            if ($version_dir) {
                return $version_dir.$this->get_user_path().$file_name;
            }
            $version_path = $version.'/';
        }
        return $this->options['upload_dir'].$this->get_user_path()
        .$version_path.$file_name;
    }

//     protected function readfile($file_path) {
//         $file_size = $this->get_file_size($file_path);
//         $chunk_size = $this->options['readfile_chunk_size'];
//         if ($chunk_size && $file_size > $chunk_size) {
//             $handle = fopen($file_path, 'rb');
//             while (!feof($handle)) {
//                 echo fread($handle, $chunk_size);
//                 @ob_flush();
//                 @flush();
//             }
//             fclose($handle);
//             return $file_size;
//         }
//         return readfile($file_path);
//     }

    protected function get_version_param() {
        return isset($_GET['version']) ? basename(stripslashes($_GET['version'])) : null;
    }

    protected function get_singular_param_name() {
        file_put_contents("./log.txt", "name: ".$this->options['param_name']."\r",FILE_APPEND);
        return substr($this->options['param_name'], 0, -1);
    }

    protected function get_file_name_param() {
        $name = $this->get_singular_param_name();
        file_put_contents("./log.txt", "name: ".$_REQUEST[$name]."\r",FILE_APPEND);
        return isset($_REQUEST[$name]) ? basename(stripslashes($_REQUEST[$name])) : null;
    }

    protected function get_file_names_params() {
        //file_put_contents("./log.txt",is_array($_REQUEST[$this->options['param_name']])."\r",FILE_APPEND);file_put_contents("./log.txt",is_array($_REQUEST[$this->options['param_name']])."\r",FILE_APPEND);
        //$params = explode(",", $paramsStr);
        $params = isset($_REQUEST[$this->options['param_name']]) ?
        explode(",",$_REQUEST[$this->options['param_name']]) : array();
        
//         $var = gettype($params);
// //         if(is_array($params)){
// //            file_put_contents("./log.txt","1"."\r",FILE_APPEND);
// //         }else { 
// //             file_put_contents("./log.txt","0"."\r",FILE_APPEND);
// //         }
//         file_put_contents("./log.txt",$var."\r",FILE_APPEND);
        foreach ($params as $key => $value) {
         //   file_put_contents("./log.txt", $key."=>".$value."\r",FILE_APPEND);
            $params[$key] = basename(stripslashes($value));
        }
        return $params;
    }
    public function download() {
            //file_put_contents("./log.txt", "download",FILE_APPEND);
            $file_names = $this->get_file_names_params();
            $zip=new ZipArchive;
            $filename = "./image.zip";
            $zip->open($filename,ZipArchive::OVERWRITE);
            
            if (empty($file_names)) {
                $file_names = array($this->get_file_name_param());
            }
          //  $response = array();
            foreach($file_names as $file_name) {
                $file_path = $this->get_upload_path($file_name);
               
                  //     file_put_contents("./log.txt", $file_path."\r",FILE_APPEND);
                       $zip->addFile($file_path,$file_name);
                    

//                $success = is_file($file_path) && $file_name[0] !== '.' ;
//                 if ($success) {
//                     foreach($this->options['image_versions'] as $version => $options) {
//                         if (!empty($version)) {
//                             $file = $this->get_upload_path($file_name, $version);
//                             if (is_file($file)) {
//                                 //unlink($file);
//                                 file_put_contents("./log.txt", $file."\r",FILE_APPEND);
//                             }
//                         }
//                     }
//                 }
             //   $response[$file_name] = $success;
            }
            echo $filename;
           //return  header("Location: down.php?name=".$filename);
           // return $this->generate_response($response, $print_response);
        }
  

}