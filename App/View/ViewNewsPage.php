<div id="all-news-page">
    <div id="background-news-page"></div>
    <div id="layer-news-page"></div>
    <div class="container" id="container-news-page">
        <div id="article-content">
            <h4 class="p-3 font-weight-bold"><?= htmlspecialchars($post['title']); ?></h4>
            <div class="content-post container p-4">
                <p><?= $post['content']; ?></p>
            </div>
            <div class="author-post p-2">
                <p><span class="font-weight-bold"><?= htmlspecialchars($post['author']); ?></span> - <span class="font-weight-bold"><?= $post['date_post']; ?></span></p>
            </div>
        </div>
        <div id="comment-content" class="p-3">
            <div id="comment-form" class="p-3">
                <form method="POST" action="index.php?p=comment" id="form-comment">
                    <div class="form-group">
                        <label for="author" class="">Votre pseudo</label><input type="text" class="form-control" name="author_comment" id="author_comment" />
                        <div id="msg-invalid-pseudo"></div>
                    </div>
                    <div class="form-group">
                        <label for="comment" class="">Votre commentaire</label>
                        <textarea class="form-control" name="comment" id="comment" rows="2" cols="50" required></textarea>
                    </div>
                    <input type="hidden" name="idPost" value="<?= $post['id'] ?>" />
                    <button type="submit" class="btn" id="btn-submit-comment">Envoyer</button>
                </form>
            </div>
            <br/>
            <hr>
            <h4 class="font-weigh-bold">Commentaires:</h4>
            <hr/>
            <div id="commentary-space">
                <?php foreach($comments as $comment) : ?>
                    <div class="comment-bloc mb-3">
                        <div class="comment-bloc-title font-weight-bold pl-2 pt-1 pb-1 mb-1"><?= htmlspecialchars(ucfirst($comment['author'])); ?></div>
                        <div class="comment-bloc-content p-3">
                            <?= htmlspecialchars($comment['comment']); ?>
                            <?php if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])) :?>
                                <br/>
                                <a href="<?= "index.php?p=delete_comment&id=".$post['id']."&id_comment=".$comment['id']; ?>" onclick="return confirm('Voulez-vous supprimer ce commentaire?');" class="btn-delete-comment-post font-italic">Supprimer</a>
                            <?php else : ?>
                                <br/>
                                <a href="<?= "index.php?p=report&id=".$post['id']."&id_comment=".$comment['id']."&author=".$comment['author']."&comment=".$comment['comment']; ?>" onclick="return confirm('Voulez-vous signaler ce commentaire?');" class="font-italic">Signaler</a>
                            <?php endif; ?>
                        </div>
                        <div class="comment-bloc-author font-weight-bold pl-2 pt-1 pb-1 mt-1">Le <?=$comment['date_comment']; ?> </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div>
                <ul class="pagination justify-content-center mt-5">
                    <?php for($i=1; $i<=$totalPagesComments; $i++){
                        echo '<li class="page-item shadow-lg bg-white rounded"><a class="page-link" href="index.php?p=news_page&id='.$post['id'].'&page='.$i.'">'.$i.'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>