<?php
namespace Controller;

class HistoriqueController extends \Core\Controller
{
    public function deleteAction($params)
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else{
            $historique = new \Model\HistoriqueModel(['id' => $params[0]]);
            $historique->delete($historique->id);
            echo '<script> window.history.back(); </script>'; //shame on me
        }
    }

    public function addHAction($params)
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else{
            $historique = new \Model\HistoriqueModel(['film_id' => $params[0], 'user_id' => $_SESSION['id']]);
            $historique->create();
            echo '<script> window.history.back(); </script>'; //shame on me
        }
    }
}