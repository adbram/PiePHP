<?php
namespace Core;

/**
 * SetFiles vous prepare votre environnement de travail
 */
class SetFiles
{
    /**
     * __construct cette fonction magique (qui fait la difference hein faut le reconnaitre ;)), vous prepare un dossier "src/", qui contiendra tous les elements dont vous aurez besoin lors de l'utilisation du framework, donnez lui les tables que vous utiliserez et tous vos controlleurs, model, et vos dossiers view seront pret a l'emploi, avec des classes toute pretes
     *
     * @param  mixed $entities chaque table = une entite = une element dans "$entities", expl: ['article', 'commentaire', 'user']
     * @return void
     */
    public function __construct($entities)
    {
        $dirs = ['src/Model', 'src/View', 'src/Controller'];
        $files = [];

        foreach ($entities as $key => $value) {
            $files[] = ['src/Model/' . ucfirst($value) . 'Model.php', "<?php\nnamespace Model;\n\nclass ".ucfirst($value)."Model extends \Core\Entity\n{\n}"];
            $dirs[] = 'src/View/' . ucfirst($value);
            $files[] = ['src/Controller/' . ucfirst($value) . 'Controller.php', "<?php\nnamespace Controller;\n\nclass ".ucfirst($value)."Controller extends \Core\Controller\n{\n}"];
        }
        foreach ($dirs as $key => $value) {
            if (!file_exists($value)) {
                mkdir($value, 0777, true);
            }
        }
        foreach ($files as $key => $value) {
            if (!file_exists($value[0])) {
                file_put_contents($value[0], $value[1]);
            }
        }
    }
}
