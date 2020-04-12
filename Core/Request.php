<?php
namespace Core;

/**
 * Request nettoiera toutes vos donnees pour mettre a l'eau tout les plans des rageux qui voudraient vous hacker
 */
class Request
{
    /**
     * _queryParams contiendra les donnees POST et GET "securisees
     *
     * @var array
     */
    private $_queryParams;

    public function __construct(array $postData, array $getData)
    {
        $this->sanitizeQueryParams(array_merge($postData, $getData));
    }

    /**
     * sanitizeQueryParams la fonction qui va securiser ces donnees
     *
     * @param  mixed $queryParams
     * @return void
     */
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

    /**
     * getQueryParams fonction utilisee par tous les controlleurs qui leur retourne les donnees POST et GET apres une securisation pour pouvoir les manipuler sans danger
     *
     * @return array
     */
    public function getQueryParams()
    {
        return $this->_queryParams;
    }
}