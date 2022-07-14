<?php
require_once(__DIR__ . '/src/dao.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$dao = DAO::getInstance();

function sendError($message){
    echo json_encode([payload=>$message,error=>true]);
}

function sendSuccess($payload){
    echo json_encode([payload=>$payload,error=>false]);
}

if ($uri[1] == 'api') {
    try {
        $endpoint = $_GET['endpoint'];
        if($endpoint == 'mcq'){
            $id = $_GET['id'] ?? 1;
            $mcq = $dao->getMCQ($id);
            sendSuccess($mcq);
        }
        else if($endpoint=='mcqs'){
            $page = $_GET['page'] ?? 1;
            $mcqs = $dao->getPage($page);
            sendSuccess($mcqs);
        }
        else if($endpoint == 'search'){
            $query = $_GET['query'];
            $page = $_GET['page'] ?? 1;
            $results = $dao->searchFor($query,$page);
            sendSuccess($results);
        }
        else if($endpoint=='category'){
            $tag = $_GET['name'];
            $page = $_GET['page'] ?? 1;
            $results = $dao->getCategory($tag,$page);
            sendSuccess($results);
        }
        else if($endpoint=='count'){
            $count = $dao->getCount();
            sendSuccess($count);
        }
        else{
            sendError('Invalid endpoint');
        }
    } catch (\Throwable $th) {
        sendError($th->getMessage());
    }
}
else{
    sendError('Invalid request');
}