<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
    }

    public function getall()
    {
        echo '<pre>';
        print_r($this->UserModel->all());
        echo '</pre>';
    }

    // Search and pagination for students
    public function index() {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;

        $where = [];
        if (!empty($search)) {
            $where[] = "(last_name LIKE '%$search%' OR first_name LIKE '%$search%' OR email LIKE '%$search%')";
        }

        $offset = ($page - 1) * $perPage;
        $students = $this->UserModel->get_students($where, $perPage, $offset);
        $total = $this->UserModel->count_students($where);

        $data['students'] = $students;
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total'] = $total;
        $data['perPage'] = $perPage;
        $this->call->view('index', $data);
    }

    public function create() {
        if($this->io->method() == 'post'){
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );
            if($this->UserModel->insert($data)){
                redirect('students/index');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('create');
        }
        
    }

    public function update($id) {
        $data['students'] = $this->UserModel->find($id);
        if($this->io->method() == 'post'){
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );
            if($this->UserModel->update($id, $data)){
                redirect('students/index');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('update', $data);
        }
    }

    public function delete($id){
        if($this->UserModel->delete($id)){
            redirect('students/index');
        } else {
            echo 'Something went wrong';
        }
    }

    public function soft_delete($id){
        if($this->UserModel->soft_delete($id)){
            redirect('students/index');
        } else {
            echo 'Something went wrong';
        }
    }

    public function restore($id){
        if($this->UserModel->restore($id)){
            redirect('students/index');
        } else {
            echo 'Something went wrong';
        }
    }

}