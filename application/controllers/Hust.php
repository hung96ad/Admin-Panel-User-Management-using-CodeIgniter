<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 31/10/2018
 * Time: 12:08
 */
class Hust extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('student_model');
    }

    public function student_info(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $this->load->library('pagination');
        $count = $this->student_model->userListingCount($searchText);
        $returns = $this->paginationCompress ( "student_info/", $count, 10 );
        $data['userRecords'] = $this->student_model->userListing($searchText, $returns["page"], $returns["segment"]);
        $this->global['pageTitle'] = 'Student Info';
        $this->loadViews("student", $this->global, $data, NULL);
    }

    public function find_student_info(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $filter = $this->input->get();
        $this->load->library('pagination');
        $count = $this->student_model->filter_student_info_count($filter);
        $returns = $this->paginationCompress ( "student_info/", $count, 1000 );
        $data['userRecords'] = $this->student_model->filter_student_info($filter, $returns["page"], $returns["segment"]);
        $this->global['pageTitle'] = 'Student Info';
        $this->loadViews("student", $this->global, $data, NULL);
    }

    public function edit_student($userId){
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('student_info');
            }

            $data['dept_names'] = $this->student_model->get_dept_name();
            $data['userInfo'] = $this->student_model->getUserInfo($userId);

            $this->global['pageTitle'] = 'Edit student';

            $this->loadViews("edit_student", $this->global, $data, NULL);
        }
    }

    public function update_student(){

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules('fname','Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('dept_name','dept_name','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->edit_student($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $dept_name = $this->input->post('dept_name');

                $userInfo = array('dept_name'=>$dept_name, 'name'=> $name);

                $result = $this->student_model->editUser($userInfo, $userId);
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                redirect('hust/edit_student/' . $userId);
            }
        }
    }

    public function add_student(){
        $data['dept_name'] = $this->student_model->get_dept_name();
        $this->global['pageTitle'] = 'Add New Student';
        $this->loadViews("add_student", $this->global, $data, NULL);
    }


    public function add_new_student()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('dept_name','dept_name','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->add_student();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $dept_name = $this->input->post('dept_name');
                $id = $this->student_model->get_max_id_student()[0]->id;
                $id +=  1;

                $userInfo = array('dept_name'=>$dept_name, 'name'=> $name, 'ID'=>$id);

                $result = $this->student_model->addNewUser($userInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', $name . ' created successfully with ID ' . $id);
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }

                redirect('hust/add_student');
            }
        }
    }

    public function delete_student()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('delete'=>1);

            $result = $this->student_model->deleteUser($userId, $userInfo);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
}
?>