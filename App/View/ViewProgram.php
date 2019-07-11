<div id="all-program">
    <div id="background-program"></div>
    <div id="layer-program"></div>
    <div class="container" id="container-program">
        <div id="content-event" class="border">
            <u><h4 class="mt-4 mb-4 pl-4">Programme :</h4></u>
            <div class="content-calendar" id="content-calendar">
                <h4 class="text-center font-weight-bold p-4"><a href="<?= "index.php?p=program&month=". $previousMonth."&year=".$previousYear; ?>"><i class="fas fa-chevron-left"></i></a> <?= $months; ?> <a href="<?= "index.php?p=program&month=". $nextMonth."&year=".$nextYear; ?>"><i class="fas fa-chevron-right"></i></a></h4>
                <table id="calendar" class="mb-5">
                    <?php for ($i = 0; $i < $weeks; $i++): ?>
                    <tr>
                        <?php foreach($days as $k => $day) : 
                        $date = (clone $firstMonday)->modify("+" . ($k + $i * 7) . "days");
                        $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                        ?>
                            <?php if($firstDay->format('Y-m') !== $date->format('Y-m')): ?>
                                <td class="calendar_ day calendar_othermonth">
                            <?php else : ?>
                                <td class="calendar_day">
                            <?php endif; ?>
                                <?php if($i === 0): ?>
                                    <div class="days font-weight-bold text-center pt-2 pb-2 mb-2"><?= $day; ?></div>
                                <?php endif; ?>
                                <div class="date_day font-weight-bold"><?= $date->format('d'); ?></div>                                
                                <?php foreach ($eventsForDay as $event): ?>
                                    <a href="<?= "index.php?p=page_event&id=".$event['id'] ?>">
                                    <div class="calendar_event">
                                        <div class="p-1"><span class="time_event font-weight-bold"><?= (new DateTime($event['date_event']))->format('H:i') ?> :</span> <?= $event['name_event']; ?></div>
                                        <hr>
                                    </div>
                                    <button type="button" class="calendar_icon btn" data-toggle="modal" data-target="#eventModal"><i class="far fa-calendar-times"></i></button>
                                    </a>
                                <?php endforeach ; ?>       
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endfor; ?>
                </table>
            </div>
            
        </div>
    </div>
</div>