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
        <?php foreach($data AS $dataArticle): ?>
            <tr>
                <td><?= implode('</td><td>', $dataArticle); ?></td>
                <!-- <?php echo '<pre>'; print_r($dataArticle); echo '</pre>'; ?> -->
                <td><a href="?op=select&id=<?= $dataArticle[$id] ?>" class="btn btn-success"><i class="fas fa-eye"></i></a></td>
                <td><a href="?op=update&id=<?= $dataArticle[$id] ?>" class="btn btn-primary"><i class="far fa-edit"></i></a></td>
                <td><a href="?op=delete&id=<?= $dataArticle[$id] ?>" class="btn btn-danger" onclick="return(confirm('Vous êtes sur le point de supprimer cet article. En êtes vous certain ?'))"><i class="far fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="container mt-5 mb-5 text-center">
    <a href="?op=add" class="btn btn-primary">Nouvel article</a>
</div>

