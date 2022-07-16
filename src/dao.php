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
        return self::$queryBuilder->select(['stem', 'opt1', 'opt2', 'opt3', 'opt4', '_id', 'disc'])->orderBy(['_id' => 'asc'])->limit($pageSize)->skip(($page - 1) * $pageSize)->getQuery()->fetch();
    }
    function getMCQ($id)
    {
        return self::$db->findById($id);
    }
    function searchFor($query, $page = 1)
    {
        return self::$queryBuilder->search(['stem', 'description'], $query)->orderBy(['searchScore' => 'desc'])->select(['_id', 'stem', 'opt1', 'opt2', 'opt3', 'opt4'])->limit(10)->skip($page - 1)->getQuery()->fetch();
    }
    function getCategory($tag, $page = 1)
    {
        return self::$queryBuilder->search(['tags'], $tag)->orderBy(['searchScore' => 'desc'])->select(['_id', 'stem', 'opt1', 'opt2', 'opt3', 'opt4'])->limit(10)->skip($page - 1)->getQuery()->fetch();
    }
    function getCount()
    {
        return self::$db->count();
    }
    function addMCQ($mcq)
    {
        return self::$db->updateOrInsert($mcq)['_id'];
    }
}
