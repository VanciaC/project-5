<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="public/css/style.css">
        <script src=https://cloud.tinymce.com/5-testing/tinymce.min.js></script>
  		<script>tinymce.init({ selector: "textarea.editme"});</script>
	</head>
	<body>
        <div id="all">
            <header>
                <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-primary" class="mb-5">
                    <a class="navbar-brand" href="index.php">Overcraft Bar</a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="navbarColor01" style="">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=news">Actualités</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=program">Programme</a>
                            </li>
                        </ul>
                        <hr/>
                        <?php if(isset($_SESSION['admin']) AND !empty($_SESSION['admin'])) :?>
                            <h4 class="text-white mr-4"><?= ucfirst($_SESSION['admin']); ?></h4>
                            <a href="index.php?p=member_page"><button class="btn btn-secondary mr-3" type="submit">Administration</button></a>
                            <a href="index.php?p=deconnexion"><button class="btn btn-secondary" type="submit">Déconnexion</button></a>
                        <?php else : ?>
                            <form class="form-inline my-2 my-lg-0" method="POST" action="index.php?p=member_page">
                                <input name="pseudo_form" id="pseudo_form" class="form-control mr-sm-2" type="text" placeholder="Pseudo" required>
                                <input name="pass_form" id="pass_form" class="form-control mr-sm-2" type="password" placeholder="Mot de passe" required>
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Connexion</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </nav>
            </header>
            <section id="all">
                <?= $content; ?>
            </section>
            <footer class="p-2">
                <p class="text-center text-white">Copyright Vancia CHAN - Projet 5 - OpenClassrooms</p>
            </footer>
        </div>
        <!--Script-->
        <script src="https://code.jquery.com/jquery-3.4.0.slim.min.js" integrity="sha256-ZaXnYkHGqIhqTbJ6MB4l9Frs/r7U4jlx7ir8PJYBqbI=" crossorigin="anonymous"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="public/js/ajax.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-aXa3H72jVym-jRGUYXTn5GwrARSrOZw"></script>
        <script src="public/js/maps.js"></script>
        <script src="public/js/animation.js"></script>
        <script src="public/js/validation.js"></script>
        <script src="public/js/event.js"></script>
	</body>
</html>