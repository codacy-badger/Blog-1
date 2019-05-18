<?php


    $title = $post->getTitle();
    $p_id = $post->getId();
    $p_dateUpd = $post->getDateUpdate() ;
    $p_content = $post->getContent();
    $p_author = $post->getUid();


require_once('View/layout.php'); ?>

<body>
    <?php require ('View/header.php'); ?>

    <h1><?= $title ?></h1>
    <p><a href="<?= $directory ?>/index.php?access=blog">Retour à la liste des billets</a></p>
    <?php
        if(isset($_SESSION['Statut_id']) && $_SESSION['Statut_id'] == 2){ ?>
            <p><a href="<?=$directory ?>/index.php?id=<?= $p_id ?>&access=blog!modifypost">Modifier</a></p>
        <?php }
    ?>

    <div class="news">
        <h3>
            Par <?= $p_author;?>
            <em>le <?= $p_dateUpd ?></em>
        </h3>

        <p>
            <?= nl2br($p_content); ?>
        </p>
    </div>
    <h2>Commentaires</h2>
    <?php
    if(isset($_SESSION['Statut_id'])){
        if($_SESSION['Statut_id'] == 1 || $_SESSION['Statut_id'] == 2 ){ ?>
            <form action="<?= $directory ?>/index.php?access=comment!publish" method="post">
                <label for="comment">Commentaire</label>
                <textarea type="text" id="comment" name="comment"></textarea>
                <button type="submit" name="publish">Publier</button>
                <input type="text" id="id" name="id" hidden value="<?= nl2br($p_id); ?>">
            </form>
        <?php }
    }
    ?>

    <?php if(empty($comments)){
        echo 'Soyez le premier à poster un commentaire';
    }
    else{
        foreach($comments as $com)
        {
            $com_username = $com->getUUsername();
            $com_edit_username = $com->getUsUsername();
            $com_content = $com->getContent();
            $com_dateUpdate = $com->getDateComUpdate();
            $com_statut = $com->getStatutId();
            $com_id = $com->getId();
            $com_uid = $com->getUserId();
            ?>
            <div class="news">
                <h3>
                    Par <?= $com_username; ?>
                    <em>le <?= $com_dateUpdate; ?></em>
                    <?php if($com_statut == 6 && $com_username !== $com_edit_username) {
                        echo 'Modifié par '. $com_edit_username;
                    } ?>
                </h3>

                <p><?= nl2br($com_content); ?></p>
                <?php
                if(isset($_SESSION['Statut_id']) && $_SESSION['Statut_id'] == 2){ ?>
                    <p><a href="<?=$directory ?>/index.php?access=comment!modify&id=<?= $p_id ?>&commentid=<?= $com_id ?>">Modifier</a></p>
                <?php }
                elseif(isset($_SESSION['Statut_id']) && $_SESSION['id'] == $com_uid){ ?>
                    <p><a href="<?=$directory ?>/index.php?access=comment!modify&id=<?= $p_id ?>&commentid=<?= $com_id ?>">Modifier</a></p>
                <?php }
                ?>
            </div>
            <?php
        }
    } ?>

</body>