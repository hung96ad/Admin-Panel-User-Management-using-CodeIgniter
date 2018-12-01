<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 25/11/2018
 * Time: 00:44
 */

class Hash_models_network_neurol extends CI_Model
{
    function instert_sha256($data)
    {
        $this->db->insert('hash_models_network_neurol', $data);
    }

    function check_exist($data)
    {
        $query = $this->db->get_where('hash_models_network_neurol', $data);
        if ($query->num_rows()){
            return true;
        }
        return false;
    }
}