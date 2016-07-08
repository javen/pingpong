<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . './libraries/REST_Controller.php';

/**
* This Controller provides a set of APIs to GET/PUT/POST/DELETE results
* 
* @author: javen
*/

class Api extends REST_Controller {
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('result');
        $this->load->helper('url_helper');
	}

    /**
     * curl -X GET http://localhost/pingpong/api/results/
     * curl -X GET http://localhost/pingpong/api/results/id/1
     */
	public function results_get()
    {
        // Results from a data store e.g. database

        // $results = [
        //     ['id' => 1, 'agroup' => '', 'bgroup' => ''],
        //     ['id' => 2, 'agroup' => '', 'bgroup' => ''],
        //     ['id' => 3, 'bgroup' => '', 'cgroup' => '']
        // ];

        ////真实数据库中所有的key/value都会转化成字符串

        // $results = [
        //     ['id' => '1', 'agroup' => '', 'bgroup' => ''],
        //     ['id' => '2', 'agroup' => '', 'bgroup' => ''],
        //     ['id' => '3', 'agroup' => '', 'bgroup' => '']
        // ];
        $results = $this->result->get_results();
        
        $id = $this->get('id');

        // If the id parameter doesn't exist return all the results

        if ($id === NULL)
        {
            // Check if the results data store contains results (in case the database result returns NULL)
            if ($results)
            {
                // Set the response and exit
                $this->response($results, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => '数据库中还没有赛果！'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular result.
        // URL传过来的id为字符串，正好跟数据库中转成字符串的id匹配，不能转换为整型
        // $id = (int) $id;

        // Validate the id.
        if ((int) $id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response([
                'status' => false,
                'message'=> '出错了，结果id必须是大于0的整数！'
            ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the result from the array, using the id as key for retreival.
        $result = NULL;

        if (!empty($results))
        {
            foreach ($results as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $result = $value;
                }
            }
        }

        if (!empty($result))
        {
            $this->set_response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => '对不起，结果不存在或已被删除！'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * Create a new result
     * 
     * $ curl -H "Content-Type: application/json" -d '{"agroup":"","bgroup":"","cgroup":"","dgroup":"","egroup":"","start_time":"","end_time":"2016-05-24"}' localhost/pingpong/api/results
     * 
     * @return bool
     */
    public function results_post()
    {
        // data =
        // {
        //     "agroup": "",
        //     "bgroup": "",
        //     "cgroup": "",
        //     "dgroup": "",
        //     "egroup": "",
        //     "start_time": "",
        //     "end_time": "2016-05-24"
        // }
        
        $result = $this->_post_args;

        // Array
        // (
        //     [agroup] => Jack Liu, Leo Tang, Javen Chen, Adam Kong
        //     [bgroup] => 
        //     [cgroup] => 
        //     [dgroup] => 
        //     [egroup] => 
        //     [start_time] => 
        //     [end_time] => 2016-05-24
        // )

        // w/o -H "Content-Type: application/json"
        // Array
        // (
        //     [0] => {
        //             "agroup": "Jack Liu, Leo Tang, Javen Chen, Adam Kong",
        //             "bgroup": "",
        //             "cgroup": "",
        //             "dgroup": "",
        //             "egroup": "",
        //             "start_time": "",
        //             "end_time": "2016-05-24"
        //         }
        // )
        // $result = json_decode($result[0], true);

        try 
        {
            $this->result->create_results($result);
        } 
        catch (Exception $e) 
        {
            $this->response(['error' => $e->getMessage()], $e->getCode());
        }

        // CREATED (201) being the HTTP response code
        $this->set_response($result, REST_Controller::HTTP_CREATED); 
        
    }

    /**
     * Update a result
     *
     * curl -H "Content-Type:application/json" -X PUT -d '{"name": "Pigs"}' http://localhost/pingpong/api/source/goods/id/1
     *
     * @return bool
     */
    public function results_put()
    {
        $result = $this->_put_args;

        $id = (int) $this->get('id');
        
        if ($id === NULL or $id <= 0) 
        {
            $this->response([
                'status' => FALSE,
                'message'=> '出错了，赛果id不能为空且必须为大于零的整数！'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } 

        try {
            $this->result->update_results($id, $result);
        } 
        catch (Exception $e) 
        {
            $this->response(['error' => $e->getMessage()], $e->getCode());
        }

        $this->set_response($result, REST_Controller::HTTP_OK); 
    }

    /**
     * Delete a result
     * 
     * curl -X DELETE http://localhost/pingpong/api/results/id/1 
     *
     * @return bool
     */
    public function results_delete()
    {
        $id = (int) $this->get('id');
        if ($id === NULL or $id <= 0) 
        {
            // Set the response and exit
            // NO_CONTENT (204) being the HTTP response code
            $this->response(NULL, REST_Controller::HTTP_NO_CONTENT); 
        } 

        try 
        {
            $this->result->delete_results($id);
        } 
        catch (Exception $e) 
        {
            $this->response(['error' => $e->getMessage()], $e->getCode());
        }
        
        $message = [
            'id' => $id,
            'message' => '成功删除记录!'
        ];
        $this->set_response($message, REST_Controller::HTTP_OK); 
    }
}
