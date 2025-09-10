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

    public function index(){
        $data['students'] = $this->UserModel->all();
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