<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model {
    // Get students with optional search and pagination
    public function get_students($where = [], $limit = 5, $offset = 0) {
    $table = $this->table;
    $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY id ASC LIMIT $offset, $limit";
    $stmt = $this->db->raw($sql);
    return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function count_students($where = []) {
    $table = $this->table;
    $sql = "SELECT COUNT(*) as cnt FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
    $stmt = $this->db->raw($sql);
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
    return $row ? $row['cnt'] : 0;
    }
    
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

}