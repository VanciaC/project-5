<div id="all-update-event">
    <div id="background-update-event"></div>
    <div id="layer-update-event"></div>
    <div class="container" id="container-update-event">
        <h4 class="text-danger font-weight-bold">Modifier l'article suivant : <?= $event['name_event']; ?></h4>
        <a href="index.php?p=member_page" class="btn btn-danger mt-5 mb-5">Retour à l'administatrion</a>
        <div>
            <div id="msg-invalid-event-update" class="pt-3 pb-3">
                Un des champs n'a pas été rempli.
            </div>
            <form action="index.php?p=update_event" method="POST" id="form-event-update">
                <div class="form-group">
                    <h5  class=""><label for="title-event">Titre de l'évènement </label></h5>
                    <input type="text" class="form-control" name="title-event" id="title-event-update" value="<?= $event['name_event']; ?>" />
                </div>
                <br/>
                <hr/>
                <div class="form-group">
                    <h5  class=""><label for="details-event">Description </label></h5>
                    <textarea type="text" class="form-control" name="details-event" id="details-event-update"><?= $event['description'];?></textarea> 
                </div>
                <br/>
                <hr/>
                <div class="form-group">
                    <h5  class="text-primary"><label for="date-event">Date de l'évènement</label></h5>
                    <input type="date" class="form-control text-center" name="date-event" id="date-event-update" placeholder="AAAA-MM-JJ" value="<?= $event['date_event'] ?>" required />
                </div>
                <div class="form-group">
                    <h5  class="text-primary"><label for="time-event">Début de l'évènement</label></h5>
                    <input type="time" class="form-control text-center" name="time-event" id="time-event-update" placeholder="HH:mm" required />
                </div>
                <br/>
                <hr/>
                <div class="form-group">
                    <h5  class=""><label for="pseudo-event">Animé par</label></h5>
                    <input type="text" class="form-control" name="pseudo-event" id="pseudo-event-update" value="<?= $event['animator']; ?>" />
                </div>
                <br/>
                <hr/>
                <input type="hidden" name="idEvent" value="<?= $event['id']; ?>" />
                <button type="submit" class="btn btn-danger btn-lg btn-block">Modifier</button>
                <br/>
                <br/>
            </form>
        </div>
    </div>
</div>