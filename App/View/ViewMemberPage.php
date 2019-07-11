<div id="all-admin">
    <div id="background-admin"></div>
    <div id="layer-admin"></div>
    <div id="container-member-page" class="container">
        <div class="row">
            <div class="col-lg-3 mb-3" id="menu-admin">
                <div class="nav flex-column nav-pills text-center pt-3 pb-3" id="nav-member-page" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="nav-add-post" data-toggle="pill" href="#add-post" role="tab" aria-controls="add-post" aria-selected="false">Ajouter un article</a>
                    <a class="nav-link" id="nav-update-post" data-toggle="pill" href="#update-post" role="tab" aria-controls="update-post" aria-selected="false">Modifier un article</a>
                    <a class="nav-link" id="nav-delete-post" data-toggle="pill" href="#delete-post" role="tab" aria-controls="delete-post" aria-selected="false">Supprimer un article</a>
                    <a class="nav-link" id="nav-admin-comment" data-toggle="pill" href="#admin-comment" role="tab" aria-controls="admin-comment" aria-selected="false">Gestion des commentaires</a>
                    <a class="nav-link" id="nav-admin-event" data-toggle="pill" href="#admin-event" role="tab" aria-controls="admin-event" aria-selected="false">Ajouter un évènement</a>
                    <a class="nav-link" id="nav-update-event" data-toggle="pill" href="#update-event" role="tab" aria-controls="update-event" aria-selected="false">Modifier un évènement</a>
                    <a class="nav-link" id="nav-delete-event" data-toggle="pill" href="#delete-event" role="tab" aria-controls="delete-event" aria-selected="false">Supprimer un évènement</a>
                </div>
            </div>
            <div id="content-member-page" class="col-lg-9 border">
                <div class="tab-content" id="v-pills-tabContent">
                    <!--Add post-->
                    <div class="tab-pane fade show active" id="add-post" role="tabpanel" aria-labelledby="nav-add-post">
                        <h4 class="text-center">Ajouter un article</h4>
                        <div id="msg-invalid-post" class="pt-3 pb-3">
                            Un des champs n'a pas été rempli.
                        </div>
                        <form action="index.php?p=add_post" method="POST" id="form-post">
                            <div class="form-group">
                                <h5  class="text-primary"><label for="title">Titre</label></h5>
                                <input type="text" class="form-control" name="title" id="title-form" />
                            </div>
                            <div class="form-group">
                                <h5  class="text-primary"><label for="details">Détails</label></h5>
                                <textarea type="text" class="form-control" name="details" id="details"></textarea>
                            </div>
                            <div class="form-group">
                                <h5  class="text-primary"><label for="content-form">Contenu</label></h5>
                                <textarea type="text" class="form-control editme" name="content" id="content-form"  rows="15" cols="50"></textarea>
                            </div> 
                            <div class="form-group">
                                <h5  class="text-primary"><label for="author">Auteur</label></h5>
                                <input type="text" class="form-control" name="author" id="author-form" value="<?= $_SESSION['admin']; ?>" required/> 
                            </div>
                            <br/>
                            <br/>
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="submit-post">Ajouter</button>
                        </form>
                    </div>
                    <!--Update post-->
                    <div class="tab-pane fade" id="update-post" role="tabpanel" aria-labelledby="nav-update-post">
                        <h4 class="text-center p-2 mb-5">Modifier un article</h4>
                        <?php foreach($postsUpdate as $postUpdate): ?>
                            <div class="border_post container row justify-content-around p-1">
                                <div class="col-md-6">
                                    <h5 class="text-center"><?= $postUpdate['title']; ?></h5>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="<?= "index.php?p=update_page&id=".$postUpdate['id']; ?>" class="btn btn-secondary text-white">Modifier l'article</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!--Delete post-->
                    <div class="tab-pane fade" id="delete-post" role="tabpanel" aria-labelledby="nav-delete-post">
                        <h4 class="text-center p-2 mb-5">Supprimer un article</h4>
                        <?php foreach($postsDelete as $postDelete): ?>
                            <div class="border_post container row justify-content-around p-1">
                                <div class="col-md-6">
                                    <h5 class="text-center"><?= $postDelete['title']; ?></h5>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="<?= "index.php?p=delete_post&id=".$postDelete['id']; ?>" class="btn-delete-post btn btn-secondary text-white" onclick="return confirm('Voulez-vous supprimer cet article');">Supprimer l'article</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!--Admin comment-->
                    <div class="tab-pane fade" id="admin-comment" role="tabpanel" aria-labelledby="nav-admin-comment">
                        <h4 class="text-center">Gestion des commentaires</h4>
                        <?php foreach($reports as $report): ?>
                                <div class="border_comment container row justify-content-around">
                                    <div class="author-admin-bloc col-md-3 text-center border pt-1">
                                        <p class="font-weight-bold">Auteur</p>
                                        <p class="p-1"><?= $report['author']; ?></p>
                                    </div>
                                    <div class="comment-admin-bloc col-md-6 text-center border pt-1">
                                        <p class="font-weight-bold">Commentaire</p>
                                        <p class="p-1"><?= $report['comment']; ?><p>
                                    </div>
                                    <div class="admin-bloc-choice col-md-3 text-center border pt-1">
                                        <a href="<?= "index.php?p=delete_report&id_comment=".$report['id_comment']; ?>" class="btn-comment-delete">Supprimer</a>
                                            <br/>
                                        <a href="<?= "index.php?p=cancel_report&id_comment=".$report['id_comment']; ?>" class="btn-comment-cancel">Annuler</a>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                    </div>
                    <!--Add event-->
                    <div class="tab-pane fade" id="admin-event" role="tabpanel" aria-labelledby="nav-admin-event">
                        <h4 class="text-center">Ajouter un évènement</h4>
                        <div id="msg-invalid-event" class="pt-3 pb-3">
                            Un des champs n'a pas été rempli.
                        </div>
                        <form action="index.php?p=add_event" method="POST" id="form-event">
                            <div class="form-group">
                                <h5  class="text-primary"><label for="title-event">Titre de l'évènement</label></h5>
                                <input type="text" class="form-control" name="title-event" id="title-event" />
                            </div>
                            <div class="form-group">
                                <h5  class="text-primary"><label for="details-event">Description</label></h5>
                                <textarea type="text" class="form-control" name="details-event" id="details-event"></textarea>
                            </div>
                            <div class="form-group">
                                <h5  class="text-primary"><label for="date-event">Date de l'évènement</label></h5>
                                <input type="date" class="form-control" name="date-event" id="date-event" placeholder="AAAA-MM-JJ" required/>
                            </div>
                            <div class="form-group">
                                <h5  class="text-primary"><label for="time-event">Heure de l'évènement</label></h5>
                                <input type="time" class="form-control" name="time-event" id="time-event" placeholder="HH:mm" required/>
                            </div> 
                            <div class="form-group">
                                <h5  class="text-primary"><label for="pseudo-event">Animé par</label></h5>
                                <input type="text" class="form-control" name="pseudo-event" id="pseudo-event" value="<?= $_SESSION['admin']; ?>" required/> 
                            </div>
                            <br/>
                            <br/>
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="submit-event">Ajouter</button>
                        </form>
                    </div>
                    <!--Update event -->
                    <div class="tab-pane fade" id="update-event" role="tabpanel" aria-labelledby="nav-update-event">
                        <h4 class="text-center p-2 mb-5">Modifier un évènement</h4>
                        <?php foreach($eventsUpdate as $eventUpdate): ?>
                            <div class="border_post container row justify-content-around p-1">
                                <div class="col-md-6">
                                    <h5 class="text-center"><?= $eventUpdate['name_event']; ?></h5>
                                    <p class="text-center">Le <?= (new DateTime($eventUpdate['date_event']))->format('d/m/Y à H:i') ?>.</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="<?= "index.php?p=update_event_page&id=".$eventUpdate['id']; ?>" class="btn btn-secondary text-white">Modifier l'évènement</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tab-pane fade" id="delete-event" role="tabpanel" aria-labelledby="nav-delete-event">
                        <h4 class="text-center p-2 mb-5">Supprimer un article</h4>
                        <?php foreach($eventsDelete as $eventsDelete): ?>
                            <div class="border_post container row justify-content-around p-1">
                                <div class="col-md-6">
                                    <h5 class="text-center"><?= $eventsDelete['name_event']; ?></h5>
                                    <p class="text-center">Le <?= (new DateTime($eventsDelete['date_event']))->format('d/m/Y à H:i') ?>.</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="<?= "index.php?p=delete_event&id=".$eventsDelete['id']; ?>" class="btn-delete-event btn btn-secondary text-white" onclick="return confirm('Voulez-vous supprimer cet article');">Supprimer l'article</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>