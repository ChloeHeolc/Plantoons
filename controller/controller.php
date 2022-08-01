<?php

namespace controller;

class Controller 
{
    private $dbEntityRepository;

    public function __construct()
    {
        $this->dbEntityRepository = new \model\EntityRepository;
        // echo '✅ Instanciation de la classe Controller réussi !';
    }

    // Méthode permettant le pilotage de notre application
    public function handleRequest()
    {
        // On stocke la valeur de l'indice "op" transmis dans l'url
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;

        try
        {
            if($op == 'add' || $op == 'update')
                $this->save($op); // si on ajoute ou modifie un article, la méthode save() sera exécutée
            elseif($op == 'select')
                $this->select();  // si on sélectionne un article, la méthode select() sera exécutée
            elseif($op == 'delete')
                $this->delete();  // si on supprime un article, la méthode delete() sera exécutée
            elseif($op == 'action')
                $this->selectAllAction();
            else 
                $this->selectAll(); // Dans les autres cas, nous voulons afficher l'ensemble des articles, la méthode selectAll() sera exécutée

        }
        catch(\Exception $e)
        {
            echo "🛑 Une erreur est survenue : " . $e->getMessage();
        }


    }

    // Méthode permettent de construire une vue (une page de notre application)
    public function render($layout, $template, $parameters = array()){
        //extract() : fonction prédéfinie qui permet d'extraire chaque indice d'un tableau ARRAY sous forme de variable
        extract($parameters); //$parameters['article'] ---> $article
        //permet de faire une mise en tampon, on commence à garder en mémire de la données
        ob_start();
        //Cette inclusion sera stockée directement dans la variable $content
        require_once "view/$template";
        //On stock dans la variable $content le template
        $content = ob_get_clean();
        //On temporise la sortie d'affichage
        ob_start();
        //On inclue le layout qui est le gabarit de base (header/nav/footer)
        require_once "view/$layout";
        //ob_end_flush() va libérer et fait tout apparaitre dans le navigateur
        //envoi les données de la mise en mémoire dans le navigateur
        return ob_end_flush();
    }


    
    //Méthode permettant d'afficher tous les articles
    public function selectAll(){
        $this->render('layout.php', 'affichage-article.php',[
            'title' => 'Affichage de tous les articles',
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez un tableau contenant l'ensemble des articles du blog"
        ]);
        $this->render('layout.php', 'affichage-membre.php',[
            'title' => 'Affichage de tous les membres',
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez un tableau contenant l'ensemble des membres du blog"
            ]);
    }



    public function selectAllAction(){
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'affichage-article.php', [
            'title' => 'Affichage de tous les articles',
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => 'id_' . $this->dbEntityRepository->getFields(),
            'id' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez un tableau contenant l'ensemble des articles du blog",
            'alert' => "L'action sur l'article n°$id à été effectuer avec succés !"
        ]);
    }

    //Méthodes permettant de sélectionner et d'afficher le détail d'un article
    public function select(){
        $id = isset($_GET['id']) ? $_GET : NULL;

        $this->render('layout.php', 'detail-article.php', [
            'title' => "Affichage des informations de cette plante",
            'data' => $this->dbEntityRepository->selectEntityRepo($id),
            'id' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez les informations sur la plante n°$id"
        ]);
    }
    
    //Méthode permettant de supprimer un article
    public function delete(){
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $data = $this->dbEntityRepository->deleteEntityRepo($id);

        $this->render('layout.php', 'affichage-article.php', [
            'title' => "Affichage de tous les articles",
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez un tableau contenant l'ensemble des articles du blog",
            'alert' => "✅ L'article n°$id à bien été supprimer de la base de données du blog"
        ]);
    }

    //Méthode permettant de faire une redirection
    public function redirect($location){
        header('Location: ' . $location);
    }

    //Méthode permettant d'enregistrer un article
    public function save($op){
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $values = ($op == 'update') ? $this->dbEntityREpository->selectEntityRepo($id) : '';

        if($_POST){
            $res = $this->dbEntityRepository->saveEntityRepo();
            $this->redirect("?op=action&id=$id");
        }

        $this->render('layout.php', 'contact-form.php', [
            'title' => "Formulaire",
            'op' => $op,
            'fields' => $this->dbEntityRepository->getFields(),
            'values' => $values,
            'message' => "Ci-dessous vous trouverez le formulaire pour ajouter ou modifier un article"
        ]);

    }
}