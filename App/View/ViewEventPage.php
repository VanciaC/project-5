<div id="all-event-page">
    <div id="background-event-page"></div>
    <div id="layer-event-page"></div>
    <div class="container" id="container-event-page">
        <div class="container p-4">
            <h4 class="font-weight-bold"><i class="fas fa-mug-hot"></i> <?= $event['name_event'] ?></h4>
            <p class="ml-4">Début de l'évènement : <?= (new DateTime($event['date_event']))->format('H:i') ?></p>
            <hr class="ml-4 mr-4">
            <div id="description-event-page" class="mt-5">
                <u><h5 class="p-3 ml-2">Description:</h5></u>
                <p class="p-3 ml-4 mr-4"><?= $event['description']?></p>
            </div>
            <div id="animator-event" class="p-4">
                <h5 class="text-right">Animé par <strong><u><?= ucfirst($event['animator']) ?></u></strong>.</h5>
            </div>
        </div>
    </div>
</div>