<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Get user records with optional search and pagination
    public function page($q, $records_per_page = null, $page = null)
    {

        // If no page is provided, return all users
        if (is_null($page)) {
            return $this->db->table($this->table)->get_all();
        } else {
            // Start query on users table
            $query = $this->db->table($this->table);

            // Add search for id, first name, last name, or email
            $query->like('id', '%' . $q . '%')
                ->or_like('first_name', '%' . $q . '%')
                ->or_like('last_name', '%' . $q . '%')
                ->or_like('email', '%' . $q . '%')
                ->or_like('status', '%' . $q . '%');

            // Copy query to count total matching rows
            $countQuery = clone $query;

            // Get total number of rows that match the search
            $data['total_rows'] = $countQuery->select_count('*', 'count')
                ->get()['count'];

            // Get records for the current page
            $data['records'] = $query->pagination($records_per_page, $page)
                ->get_all();

            // Return total rows and page records
            return $data;
        }
    }
}