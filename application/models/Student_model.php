<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model
{
    function userListingCount($searchText = '')
    {
        $this->db->select('s.ID');
        $this->db->from('student_class as s');
        if(!empty($searchText)) {
            $likeCriteria = "(s.ID  LIKE '%".$searchText."%'
                            OR  s.`student_name`  LIKE '%".$searchText."%'
                            OR  s.`year`  LIKE '%".$searchText."%'
                            OR  s.`semester`  LIKE '%".$searchText."%'
                            OR  s.`course_id`  LIKE '%".$searchText."%'
                            OR  s.`dept_name`  LIKE '%".$searchText."%'
                            OR  s.`room_number`  LIKE '%".$searchText."%'
                            OR  s.`teacher_name`  LIKE '%".$searchText."%'
                            OR  s.`building`  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();

        return $query->num_rows();
    }

    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('s.ID,
                            s.student_name,
                            s.department_name,
                            s.`year`,
                            s.semester,
                            s.course_id,
                            s.dept_name,
                            s.room_number,
                            s.teacher_name,
                            s.building,
                            CONCAT(s.`day`, " ", s.start_hr, ":", s.start_min, "-", s.end_hr, ":", s.end_min) time');
        $this->db->from('student_class as s');
        if(!empty($searchText)) {
            $likeCriteria = "(s.ID  LIKE '%".$searchText."%'
                            OR  s.`student_name`  LIKE '%".$searchText."%'
                            OR  s.`year`  LIKE '%".$searchText."%'
                            OR  s.`semester`  LIKE '%".$searchText."%'
                            OR  s.`course_id`  LIKE '%".$searchText."%'
                            OR  s.`dept_name`  LIKE '%".$searchText."%'
                            OR  s.`room_number`  LIKE '%".$searchText."%'
                            OR  s.`teacher_name`  LIKE '%".$searchText."%'
                            OR  s.`building`  LIKE '%".$searchText."%'
                            OR  s.`day`  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('s.ID', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function filter_student_info($filter,$page, $segment)
    {
        $this->db->select('s.ID,
                            s.student_name,
                            s.department_name,
                            s.`year`,
                            s.semester,
                            s.course_id,
                            s.dept_name,
                            s.room_number,
                            s.teacher_name,
                            s.building,
                            CONCAT(s.`day`, " ", s.start_hr, ":", s.start_min, "-", s.end_hr, ":", s.end_min) time');
        $this->db->from('student_class as s');
        $this->db->where($filter);
        $this->db->order_by('s.ID', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function filter_student_info_count($filter)
    {
        $this->db->select('s.ID,
                            s.student_name,
                            s.department_name,
                            s.`year`,
                            s.semester,
                            s.course_id,
                            s.dept_name,
                            s.room_number,
                            s.teacher_name,
                            s.building,
                            CONCAT(s.`day`, " ", s.start_hr, ":", s.start_min, "-", s.end_hr, ":", s.end_min) time');
        $this->db->from('student_class as s');
        $this->db->where($filter);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_dept_name()
    {
        $this->db->select('dept_name');
        $this->db->from('department');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function get_max_id_student(){
        $this->db->select('MAX(ID) id');
        $this->db->from('student');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function addNewUser($userInfo){
        $this->db->trans_start();
        $this->db->insert('student', $userInfo);
        $this->db->trans_complete();
        return 1;
    }

    function getUserInfo($userId){
        $this->db->select('*');
        $this->db->from('student');
        $this->db->where('delete', 0);
        $this->db->where('ID', $userId);
        $query = $this->db->get();

        return $query->row();
    }
    function editUser($userInfo, $userId)
    {
        $this->db->where('ID', $userId);
        $this->db->update('student', $userInfo);

        return TRUE;
    }
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('ID', $userId);
        $this->db->update('student', $userInfo);

        return $this->db->affected_rows();
    }
}