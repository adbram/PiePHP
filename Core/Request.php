<?php
namespace Core;

class Request
{
    private $_queryParams;

    public function __construct(array $postData, array $getData)
    {
        $this->sanitizeQueryParams(array_merge($postData, $getData));
    }

    public function sanitizeQueryParams(array $queryParams)
    {
        if(!empty($queryParams)) {
            foreach($queryParams as $key => $value) {
                if($key != 'password') {
                    $queryParams[$key] = trim(filter_var(htmlspecialchars(stripslashes($value)), FILTER_SANITIZE_STRING));
                }
            }
        }
        $this->_queryParams = $queryParams;
    }

    public function getQueryParams()
    {
        return $this->_queryParams;
    }
}