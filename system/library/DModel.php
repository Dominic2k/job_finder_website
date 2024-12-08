<?php
class DModel {
    protected $db;
    public function __construct() {
        $connect = 'mysql:dbname=finder_job_db; host=localhost; charset=utf8';
        $user = 'root';
        $pass = '';
        $this->db = new Database($connect, $user, $pass);
    }
}