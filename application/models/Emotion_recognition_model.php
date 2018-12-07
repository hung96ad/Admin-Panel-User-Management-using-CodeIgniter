<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 05/12/2018
 * Time: 18:12
 */

class Emotion_recognition_model extends CI_Model
{
    function instert_data($data)
    {
        $this->db->insert('emotion_recognition', $data);
    }

    function find_by_file_hash_md5($file_hash_md5)
    {
        $query = $this->db->get_where('emotion_recognition', array('file_hash_md5' => $file_hash_md5));
        if ($query->num_rows()){
            return $query->first_row();
        }
        return false;
    }
}