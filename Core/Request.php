<?php
namespace Core;

class Request
{
    private $_postData;
    private $_getData;

    public function __construct(array $postData, array $getData)
    {
        $this->sanitizePost($postData);
        $this->sanitizeGet($getData);
    }

    public function sanitizePost(array $postData)
    {
        if(!empty($this->_postData)) {
            foreach($this->_postData as $key => $value) {
                if($key != 'password') {
                    $this->_postData[$key] = trim(filter_var(htmlspecialchars(stripslashes($value)), FILTER_SANITIZE_STRING));
                }
            }
        }
        $this->_postData = $postData;
    }

    public function sanitizeGet(array $getData)
    {
        if(!empty($this->_getData)) {
            foreach($this->_getData as $key => $value) {
                if($key != 'password') {
                    $this->_getData[$key] = trim(filter_var(htmlspecialchars(stripslashes($value)), FILTER_SANITIZE_STRING));
                }
            }
        }
        $this->_getData = $getData;
    }

    public function getPostData()
    {
        return $this->_postData;
    }

    public function getGetData()
    {
        return $this->_getData;
    }
}