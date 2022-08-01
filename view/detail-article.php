
<?php

// echo '<pre>'; print_r($data) ;echo '</pre>';

?>



<div class="container mt-5">
    <div class="card" style="width: 18rem; margin: 0 auto;">
<?php

    if($data['sexe'] == 'm'){
        echo '<img src="https://picsum.photos/id/1005/200/150" alt="photo de l\'employé" class="card-img-top">';
    }else{
        echo '<img src="https://picsum.photos/id/1011/200/150" alt="photo de l\'employé" class="card-img-top">';
    }
    ?>

    <div class="card-body">
        <h5 class="card-title text-center mb-4 mt-4"><?= $data['prenom'] . ' ' . $data['nom'] ?></h5>
        <ul style="list-style: none;">
            <li><b>Id_employé</b> : <?= $data['id_employes'] ?></li>
            <li><b>Sexe</b> : <?= $data['sexe'] ?></li>
            <li><b>Service</b> : <?= $data['service'] ?></li>
            <li><b>Date_embauche</b> : <?= $data['date_embauche'] ?></li>
            <li><b>Salaire</b> : <?= $data['salaire'] . '€' ?></li>
        </ul>
        <div class="text-center">
        <a href="?op=delete&id=<?= $data[$id] ?>" class="btn btn-danger mt-4 mb-4" onclick="return(confirm('Vous etes sur le point de supprimer cet employé. En êtes vous certain ?'))">Supprimer</a>
        </div>
    </div>
</div>
<div class="container text-center mt-5">
    <a href="?op=null" class="btn btn-primary mt-5">Retour au tableau des employés</a>
</div>
</div>