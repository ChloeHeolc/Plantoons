<?php

//echo '<pre>'; print_r($data); echo '</pre>';
// echo '<pre>'; print_r($fields) ;echo '</pre>';
?>


<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th><?= $id; ?></th>
            <?php foreach($fields AS $value): ?>
                <th><?= $value['Field'] ?></th>
            <?php endforeach; ?>
            <th>Consulter</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data AS $dataMembre): ?>
            <tr>
                <td><?= implode('</td><td>', $dataMembre); ?></td>
                <!-- <?php echo '<pre>'; print_r($dataMembre); echo '</pre>'; ?> -->
                <td><a href="?op=select&id=<?= $dataMembre[$id] ?>" class="btn btn-success"><i class="fas fa-eye"></i></a></td>
                <td><a href="?op=update&id=<?= $dataMembre[$id] ?>" class="btn btn-primary"><i class="far fa-edit"></i></a></td>
                <td><a href="?op=delete&id=<?= $dataMembre[$id] ?>" class="btn btn-danger" onclick="return(confirm('Vous êtes sur le point de supprimer ce membre. En êtes vous certain ?'))"><i class="far fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="container mt-5 mb-5 text-center">
    <a href="?op=add" class="btn btn-primary">Ajouter un membre</a>
</div>

