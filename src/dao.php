<?php
error_reporting(E_ERROR);
require_once(__DIR__ . '/../vendor/autoload.php');

use SleekDB\Store;

class DAO
{
    private static $instance = null;
    private $db = null;
    private $queryBuilder = null;
    private function __construct()
    {
        $this->db = new Store('mcqs', __DIR__ . '/db');
        $this->queryBuilder = $this->db->createQueryBuilder();
    }
    static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DAO();
        }
        return self::$instance;
    }
    function getPage($page, $pageSize = 10)
    {
        return $this->queryBuilder->select(['stem', 'opt1', 'opt2', 'opt3', 'opt4', '_id'])->orderBy(['_id' => 'asc'])->limit($pageSize)->skip(($page - 1) * $pageSize)->getQuery()->fetch();
    }
    function getMCQ($id)
    {
        return $this->db->findById($id);
    }
}
