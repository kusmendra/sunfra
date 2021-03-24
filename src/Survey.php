<?php
namespace Src;

class Survey {
    private $db;
    private $requestMethod;
   

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
       
    }

    public function processRequest($option)
    {
        parse_str(file_get_contents("php://input"),$post_vars);
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllSurvey();
                break;
            case 'POST':
                $response = $this->createsurvey($_POST['surveyname']);
                break;
            case 'PUT':
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                $response['body'] = json_encode(array('message' => 'Put Request', $_REQUEST, $post_vars['name']));
                break;
            case 'DELETE':
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                $response['body'] = json_encode(array('message' => 'Delete Request', $_REQUEST, $post_vars['name']));
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    

    private function createsurvey($survey)
    {
        $query = "
        INSERT INTO survey_master
            (survey_name, created_by)
             VALUES 
             (:sname, :cby)
    ";
     
    try {
        $statement = $this->db->prepare($query);
        $statement->execute(array('sname' => $survey, 'cby' => 'kush'));
        $statement->rowCount();
    } catch (\PDOException $e) {
        exit($e->getMessage());
    } 
    $response['status_code_header'] = 'HTTP/1.1 201 Created';
    $response['body'] = json_encode(array('status' => 1, 'message' => 'Survey Created'));
    return $response;
    }

    private function getAllSurvey()
    {
        $query = "
            SELECT 
            `id`, `survey_name`, `created_by`, `created_at`
            FROM
            survey_master;
        ";

        try {
            $statement = $this->db->query($query);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

       private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}