<div id="all-update">
    <div id="background-update"></div>
    <div id="layer-update"></div>
    <div class="container" id="container-update-page">
        <h4 class="text-danger font-weight-bold">Modifier l'article suivant : <?= $post['title']; ?></h4>
        <a href="index.php?p=member_page" class="btn btn-danger mt-5 mb-5">Retour à l'administatrion</a>
        <div>
            <div id="msg-invalid-post-update" class="pt-3 pb-3">
                Un des champs n'a pas été rempli.
            </div>
            <form action="index.php?p=update_post" method="POST" id="form-post-update">
                <div class="form-group">
                    <h5  class=""><label for="title">Titre</label></h5>
                    <input type="text" class="form-control" name="title" id="title-form-update" value="<?= $post['title']; ?>" />
                </div>
                <br/>
                <hr/>
                <div class="form-group">
                    <h5  class=""><label for="details">Détails</label></h5>
                    <textarea type="text" class="form-control" name="details" id="details-form-update"><?= $post['details']; ?></textarea>
                </div>
                <br/>
                <hr/>
                <div class="form-group">
                    <h5  class=""><label for="content">Contenu</label></h5>
                    <textarea type="text" class="form-control text-justify editme" name="content" id="content-form-update"  rows="15" cols="50"><?= $post['content'];?></textarea> 
                </div>
                <br/>
                <hr/>
                <div class="form-group">
                    <h5  class=""><label for="title">Auteur</label></h5>
                    <input type="text" class="form-control" name="author" id="author-form-update" value="<?= $post['author']; ?>" />
                </div>
                <br/>
                <hr/>
                <input type="hidden" name="idPost" value="<?= $post['id']; ?>" />
                <button type="submit" class="btn btn-danger btn-lg btn-block">Modifier</button>
                <br/>
                <br/>
            </form>
        </div>
    </div>
</div>