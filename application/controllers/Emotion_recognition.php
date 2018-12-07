<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 05/12/2018
 * Time: 16:32
 */

class Emotion_recognition extends BaseController
{
    const OUTPUT_PATH = '/home/googlecloud/landipage/admin/outputs/';

    function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Emotion_recognition_model');
    }
    function index()
    {
        $data = array();
        $this->global['pageTitle'] = "Emotion recognition " ;
        $this->loadViews("emotion_recognition", $this->global, $data, NULL);
    }

    function get_config_upload(){
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png|jpeg';
//        $config['max_size']             = 2048;
//        $config['max_width']            = 1920;
//        $config['max_height']           = 1080;
        $config['encrypt_name'] = TRUE;
        return $config;
    }

    function do_upload(){
        $config = $this->get_config_upload();
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            return false;
        }
        else
        {
            return $this->upload->data();
        }
    }

    function get_data_insert_db($file_name, $file_hash_md5){
        return array(
            'user_id' => $this->vendorId,
            'file_name' => $file_name,
            'file_hash_md5' => $file_hash_md5,
            'created_at' => time()
        );
    }

    public function recognition()
    {
        if ($_FILES["userfile"]['tmp_name'] == NULL){
            $this->return_error('Please select image');
            return FALSE;
        }
        $file_hash_md5 = md5_file($_FILES["userfile"]['tmp_name']);
        $file_old = $this->Emotion_recognition_model->find_by_file_hash_md5($file_hash_md5);
        if ($file_old){
            $this->return_success($file_old->file_name);
            return true;
        }
        $file = $this->do_upload();
        if ($file){
            $img = $this->call_api_recognition($file['full_path']);
            file_put_contents(self::OUTPUT_PATH . $file['raw_name'] . '.png', $img);
            $data_db = $this->get_data_insert_db($file['file_name'], $file_hash_md5);
            $this->Emotion_recognition_model->instert_data($data_db);
            $this->return_success($file['file_name']);
        } else {
            $this->return_error($this->upload->display_errors());
            return FALSE;
        }

    }

    function return_success($file_name){
        $file_name_output = explode('.' , $file_name)[0] . '.png';
        $this->global['pageTitle'] = "Emotion recognition " ;
        $data = array(
            'image_input'   => $file_name,
            'image_output' => $file_name_output
        );
        $this->loadViews("emotion_recognition", $this->global, $data, NULL);
    }

    function return_error($msg){
        $this->global['pageTitle'] = "Emotion recognition " ;
        $data = array('error' => $msg);
        $this->loadViews("emotion_recognition", $this->global, $data, NULL);
    }

    function call_api_recognition($param){
        $result = shell_exec('curl -v -F image=@' . $param .  ' http://localhost:8084/emotionRecognition');
        return $result;
    }

    public function selfie(){
        $this->global['pageTitle'] = "Selfie" ;
        $this->loadViews("selfie", $this->global, NULL, NULL);
    }
}