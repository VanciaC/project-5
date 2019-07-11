<div id="all-news">
    <div id="background-news"></div>
    <div id="layer-news"></div>
    <div class="container" id="container-news">
        <div id="content-news" class="container border">
            <h2 class="text-center">Actualités</h2>
            <div class="p-5">
                <?php foreach($posts as $post): ?>
                    <article class="news-post mt-3">
                        <hr>
                        <h3 class="font-weight-bolder pt-1"><a href="<?= "index.php?p=news_page&id=".$post['id']; ?>"><?= htmlspecialchars($post['title']); ?></a></h3>
                        <p class="pb-3"><span class="font-weight-bolder"><?=$post['date_post'];?></span> - Ecrit par <span class="font-weight-bolder"><?= htmlspecialchars(ucfirst($post['author'])); ?></span> </p>
                        <div class="details-news">
                            <p><?=  substr($post['details'], 0, 400); ?> ...</p>
                        </div>
                        <p class="font-weight-bolder"><a href="<?= "index.php?p=news_page&id=".$post['id'] ?>">Lire la suite <i class="fas fa-arrow-right"></i></a></p>
                        <hr>
                    </article>
                <?php endforeach; ?>
            </div>
            <ul class="pagination justify-content-center">
                <?php for($i=1; $i<=$totalPages; $i++){
                    echo '<li class="page-item bg-white rounded"><a class="page-link" href="index.php?p=news&page='.$i.'">Page '.$i.' </a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>