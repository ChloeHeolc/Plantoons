<?php

namespace model;

class EntityRepository
{
    private $db; // permet de stocker un objet issu de la classe PDO, c'est à dire la connexion à la BDD
    public $table; // permet de stocker le nom de la table SQL afin de l'injecter dans les différentes requêtes SQL


    // Méthode permettant de construire la connexion à la BDD
    public function getDb()
    {
        if(!$this->db)
        {
            try
            {
                // simplexml_load_file() : fonction prédéfinie de PHP qui permet de charger un fichier XML et retourne un objet PHP SimpleXMLELement contenant les information du fichier
                $xml = simplexml_load_file('app/config.xml');
                // echo '<pre>'; print_r($xml); echo '</pre>';

                // On affecte le nom de la table récupéré via le fichier XML
                $this->table = $xml->table;

                try // On tente d'exécuter la connexion à la BDD
                {
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, [
                                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]);
                }
                catch(\PDOException $e)
                {
                    echo "🛑 Une erreur est survenu pendant la tentative de connexion à la BDD : " . $e->getMessage();
                }
            }
            catch(\Exception $e)
            {
                echo "🛑 Une erreur est survenu pendant le chargement du fichier XML : " . $e->getMessage();
            }
        }
        //print_r($this->db);
        return $this->db;
    }

    //Méthode permettant de sélectionner l'ensemble des articles dans la table "article"
    public function selectAllEntityRepo(){
        // $data (réponse de la BDD = PDOStatement) = PDO->query(requête SQL)
        $data = $this->getDb()->query(" SELECT * FROM " . $this->table);
        // $r (résultat traité par la méthode fetchAll() avec un mode FETCH_ASSOC)
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    // Méthode permettant de sélectionner tout les nom des champs de la table "article"
    public function getFields()
    {
        $data = $this->getDb()->query("DESC " . $this->table);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return array_slice($r,1);
    }


    //Méthode permettant de selectionner un article dans la BDD en fonction de son ID
    public function selectEntityRepo($id){
        $data = $this->getDb()->query("SELECT * FROM" . $this->table . "WHERE id_" . $this->table . "=" . $id);
        $r = $data->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }
    //Méthode permettant de supprimer un article de la BDD en fonction de son ID
    public function deleteEntityRepo($id){
        $data = $this->getDb()->query('DELETE FROM' . $this->table . 'WHERE id_' . $this->table . '=' . $id);
    }

    //Methode permettant d'ajouter ou modifier un article dans la base de données en fonction de son ID
    public function saveEntityRepo(){
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
        $q = $this->getDb()->query('REPLACE INTO' . $this->table . '(id_' . $this->table . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')'); 
    }
}

// Test

// $e = new EntityRepository;
// $e->getDb();