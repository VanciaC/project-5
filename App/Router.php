<?php

    namespace App;
    
    require "vendor/autoload.php";
    
    use App\Controller\Form;
    use App\Controller\ControllerHome;
    use App\Controller\ControllerNews;
    use App\Controller\ControllerProgram;
    use App\Controller\ControllerUser;
    use App\Controller\ControllerAdmin;
    use App\View\View;
    
    class Router{

        private $ctrlHome;
        private $ctrlNews;
        private $ctrlProgram;
        private $ctrlUser;
        private $ctrlAdmin;

        public function __construct(){
            $this->ctrlHome = new ControllerHome;
            $this->ctrlNews = new ControllerNews;
            $this->ctrlProgram = new ControllerProgram;
            $this->ctrlUser = new ControllerUser;
            $this->ctrlAdmin = new ControllerAdmin;
        }

        public function routerReq(){
            try{
                if (isset($_GET['p'])){
                    if($_GET['p'] === 'news'){
                        session_start();
                        if (isset($_GET['page']) AND $_GET['page'] > 0){
                            $_GET['page'] = intval(($_GET['page']));
                            $currentPage = ($_GET['page']);
                        }
                        else{
                            $currentPage = 1;
                        }
                        $this->ctrlNews->news($currentPage);
                    }

                    else if($_GET['p'] === "news_page"){
                        session_start();
                        if (isset($_GET['id'])) {
                            $idPost = intval($_GET['id']);
						    if($idPost != 0) {
                                if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0){
                                    $_GET['page'] = intval(($_GET['page']));
                                    $currentPage = ($_GET['page']);
                                }
                                else{
                                    $currentPage = 1;
                                }
                                $this->ctrlNews->getNews($idPost, $currentPage);
                            }
                        }
                        else {
                            throw new \Exception("Identifiant de billet non valide");
                        }    
                    }

                    else if($_GET['p'] === 'comment'){
                        session_start();
                        $currentPage = 1;
                        $author = $this->getParam($_POST, 'author_comment');
                        $comment = $this->getParam($_POST, 'comment');
                        $idPost = $this->getParam($_POST, 'idPost');
                        if($author !== "" AND strlen($author) > 4 AND strlen($author) < 32){
                            $this->ctrlNews->comment($author, $comment, $idPost, $currentPage);
                        }
                        else{
                            throw new \Exception("Manque pseudo.");
                        }
                    }

                    else if($_GET['p'] === 'delete_comment'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id_comment']) AND isset($_GET['id'])) {
                                $idComment = intval($_GET['id_comment']);
                                $idPost = intval($_GET['id']);
                                if($idComment != 0 AND $idPost != 0){
                                    $this->ctrlAdmin->deleteComment($idComment);
                                    $this->ctrlAdmin->deleteReport($idComment);
                                    $this->ctrlNews->getNews($idPost);
                                }
                                else {
                                    header('location: index.php');
                                }
                            }
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'report'){
                        if (isset($_GET['id']) AND isset($_GET['id_comment']) AND isset($_GET['author']) AND isset($_GET['comment'])){
                            $idPost = intval($_GET['id']);
                            $idComment = intval($_GET['id_comment']);
                            $author = htmlspecialchars($_GET['author']);
                            $comment = htmlspecialchars($_GET['comment']);
                            if($idComment != 0 AND $idPost != 0){
                                $currentPage = 1;
                                $this->ctrlNews->report($idPost, $idComment, $author, $comment, $currentPage);
                            }
                            else{
                                header('location: index.php');
                            }
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'program'){
                        session_start();
                        if(isset($_GET['month']) AND $_GET['month'] >= 1 AND $_GET['month'] <= 12){
                            $_GET['month'] = intval($_GET['month']);
                            $month = $_GET['month'];
                            if(isset($_GET['year']) AND $_GET['year'] >= 1970){
                                $_GET['year'] = intval($_GET['year']);
                                $year = $_GET['year'];
                            }
                            else{
                                throw new \Exception('Erreur sur l\'année.');
                            }
                        }
                        else{
                            $month = intval(date('m'));
                            $year = intval(date('Y'));
                        }
                        $this->ctrlProgram->program($month, $year);
                    }

                    else if($_GET['p'] === 'delete_report'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id_comment'])) {
                                $idComment = intval($_GET['id_comment']);
                                if($idComment != 0){
                                    $this->ctrlAdmin->deleteComment($idComment);
                                    $this->ctrlAdmin->deleteReport($idComment);
                                    header('location: index.php?p=member_page#admin-comment');
                                }
                                else{
                                    header('location: index.php');
                                }
                            }
                            else{
                                header('location: index.php');
                            }
                        }
                    }

                    else if($_GET['p'] === 'cancel_report'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id_comment'])) {
                                $idComment = intval($_GET['id_comment']);
                                if($idComment != 0){
                                    $this->ctrlAdmin->deleteReport($idComment);
                                    header('location: index.php?p=member_page#admin-comment');
                                }
                                else{
                                    header('location: index.php');
                                }
                            }
                            else{
                                header('location: index.php');
                            }
                        }
                    }

                    else if($_GET['p'] === 'member_page'){
                        if (isset($_POST['pseudo_form'])){
                            if (!empty(htmlspecialchars($_POST['pseudo_form'])) AND !empty(htmlspecialchars($_POST['pass_form']))){
                                $pseudo = $this->getParam($_POST, 'pseudo_form');
                                $password = ($this->getParam($_POST, 'pass_form'));
                            }
                            $password_hash = password_hash($password, PASSWORD_DEFAULT);
                            $user = $this->ctrlUser->user($pseudo);

                            if($user){
                                $correctPassword = password_verify($password, $user['password']);
                                if ($correctPassword){
                                    session_start();
                                    $_SESSION['admin'] = $pseudo;
                                    $this->ctrlUser->pageMember($_SESSION['admin']);
                                }
                                else{
                                    throw new \Exception("Identifiants incorrects.");
                                }
                            }
    
                            else{
                                throw new \Exception("Identifiants incorrect.");
                            }
                        }
                        else{
                            session_start();
                            if($_SESSION['admin']){
                                $this->ctrlUser->pageMember($_SESSION['admin']);
                            }
                            else{
                                header('location: index.php');
                            }
                        }
                    }

                    else if($_GET['p'] === 'add_post'){
                        session_start();
                        if($_SESSION['admin']){
                            $title = $this->getParam($_POST, 'title');
                            $details = $this->getParam($_POST, 'details');
                            $content = $this->getParam($_POST, 'content');
                            $author = $this->getParam($_POST, 'author');
                            if($title !== "" AND $details !== "" AND $author !== ""){
                                $this->ctrlAdmin->post($title, $details, $content, $author);
                                header('location: index.php?p=member_page');
                            }
                            else{
                                throw new \Exception("Manque un des champs.");
                            }
                        }
                        
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'update_page'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id'])) {
                                $idPost = intval($_GET['id']);
                                if($idPost != 0){
                                    $this->ctrlAdmin->updatePage($idPost);
                                }
                                else {
                                    header('location: index.php');
                                }
                            }	
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'update_post'){
                        session_start();
                        if($_SESSION['admin']){
                            $title = $this->getParam($_POST, 'title');
                            $details = $this->getParam($_POST, 'details');
                            $content = $this->getParam($_POST, 'content');
                            $idPost = $this->getParam($_POST, 'idPost');
                            $author = $this->getParam($_POST, 'author');
                            if($title !== "" AND $details !== "" AND $author !== ""){
                                $this->ctrlAdmin->updatePost($idPost, $title, $details, $content, $author);
                            }
                            else{
                                throw new \Exception("Manque un des champs.");
                            }
                        }
                        else{
                            header('location: index.php');
                        }
                    }
                    else if($_GET['p'] === 'delete_post'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id'])) {
                                $idPost = intval($_GET['id']);
                                if($idPost != 0){
                                    $this->ctrlAdmin->deletePost($idPost); 
                                    header('location: index.php?p=member_page');
                                }
                                else {
                                    header('location: index.php');
                                }
                            }
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'add_event'){
                        session_start();
                        if($_SESSION['admin']){
                            $name_event = $this->getParam($_POST, 'title-event');
                            $description = $this->getParam($_POST, 'details-event');
                            $date_event = new \DateTime($this->getParam($_POST, 'date-event') . ' ' . $this->getParam($_POST, 'time-event'));
                            $date_format = $date_event->format('Y-m-d H:i');
                            $animator = $this->getParam($_POST, 'pseudo-event');
                            if($name_event !== "" AND $description !== "" AND $animator !== "" AND preg_match("/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})/", $date_format)){
                                $this->ctrlAdmin->addEvent($name_event, $description, $date_format, $animator);
                                header('location: index.php?p=member_page');
                            }
                            else{
                                throw new \Exception("Manque un des champs.");
                            }
                        }
                        
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'update_event_page'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id'])) {
                                $idEvent = intval($_GET['id']);
                                if($idEvent != 0){
                                    $this->ctrlAdmin->updateEventPage($idEvent);
                                }
                                else {
                                    header('location: index.php');
                                }
                            }	
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'update_event'){
                        session_start();
                        if($_SESSION['admin']){
                            $name_event = $this->getParam($_POST, 'title-event');
                            $description = $this->getParam($_POST, 'details-event');
                            $date_event = new \DateTime($this->getParam($_POST, 'date-event') . ' ' . $this->getParam($_POST, 'time-event'));
                            $date_format = $date_event->format('Y-m-d H:i');
                            $animator = $this->getParam($_POST, 'pseudo-event');
                            $idEvent = $this->getParam($_POST, 'idEvent');
                            if($name_event !== "" AND $description !== "" AND $animator !== ""  AND preg_match("/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})/", $date_format)){
                                $this->ctrlAdmin->updateEvent($idEvent, $name_event, $description, $date_format, $animator);
                            }
                            else{
                                throw new \Exception("Manque un des champs.");
                            }
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'delete_event'){
                        session_start();
                        if($_SESSION['admin']){
                            if (isset($_GET['id'])) {
                                $idEvent = intval($_GET['id']);
                                if($idEvent != 0){
                                    $this->ctrlAdmin->deleteEvent($idEvent); 
                                    header('location: index.php?p=member_page');
                                }
                                else {
                                    header('location: index.php');
                                }
                            }
                        }
                        else{
                            header('location: index.php');
                        }
                    }

                    else if($_GET['p'] === 'page_event'){
                        session_start();
                        if (isset($_GET['id'])){
                            $idEvent = intval($_GET['id']);
						    if($idEvent != 0) {
                                $this->ctrlProgram->eventPage($idEvent);
                            }
                        }
                    }

                    else if($_GET['p'] === 'deconnexion'){
                        session_start();
                        session_destroy();
                        header('Location: index.php');
                        exit();
                    }
    
                    else {
                        throw new \Exception("Action non valide");
                    }
                }
                else{
                    session_start();
                    $this->ctrlHome->home();
                }
            }
            catch (\Exception $e){
                $this->error($e->getMessage());
            }
        }

        private function error($msgError){
            $view = new View("Error");
            $view->generate(array('msgError'=> $msgError));
        }

        private function getParam($array, $name){
            if(isset($array[$name])) {
                return $array[$name];
            }
            else{
                throw new \Exception("Paramètre '$name' absent.");
            }
        }
}