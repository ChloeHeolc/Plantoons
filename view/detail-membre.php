
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
        <h5 class="card-title text-center mb-4 mt-4"><?= $data['pseudo'] ?></h5>
        <ul style="list-style: none;">
            <li><b>Id_membre</b> : <?= $data['id'] ?></li>
            <li><b>Email</b> : <?= $data['mail'] ?></li>
            <li><b>Date_de_naissance</b> : <?= $data['date_naissance'] ?></li>
        </ul>
        <div class="text-center">
        <a href="?op=delete&id=<?= $data[$id] ?>" class="btn btn-danger mt-4 mb-4" onclick="return(confirm('Vous etes sur le point de supprimer cet employé. En êtes vous certain ?'))">Supprimer</a>
        </div>
    </div>
</div>
<div class="container text-center mt-5">
    <a href="?op=null" class="btn btn-primary mt-5">Retour au tableau des membres</a>
</div>
</div>