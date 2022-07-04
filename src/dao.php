<?php
error_reporting(E_ERROR);
require_once(__DIR__ . '/../vendor/autoload.php');

use SleekDB\Store;

class DAO
{
    private static $instance;
    private static $db;
    private static $queryBuilder;
    private function __construct()
    {
        self::$db = new Store('mcqs', __DIR__ . '/db');
        self::$queryBuilder = self::$db->createQueryBuilder();
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
        return self::$queryBuilder->select(['stem', 'opt1', 'opt2', 'opt3', 'opt4', '_id'])->limit($pageSize)->skip(($page - 1) * $pageSize)->getQuery()->fetch();
    }
}