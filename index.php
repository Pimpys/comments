<?php require_once 'config/config.php';
$errors = null;
$success = null;
if (!empty($_POST) && ($name = checkDataLength($_POST['name'])) && ($email = checkEmail($_POST['email']))){
    saveComment($pdo, $name, $email, clearData($_POST['message'])) ? $success = true : $errors = true;
}elseif (!empty($_POST)){
    $errors = true;
}
if (!empty($id = (int) $_GET['delete']) && findByID($pdo, $id)){
    deleteComments($pdo, $id);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>Комментарии, как сделать?</title>

        <!-- Core Stylesheet -->
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <!-- ##### Preloader ##### -->
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="circle-preloader">
                <img src="img/core-img/logo.png" alt="">
                <div class="foode-preloader">
                    <span></span>
                </div>
            </div>
        </div>

        <!-- ##### Blog Content Area Start ##### -->
        <section class="blog-content-area section-padding-0-100">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Blog Posts Area -->
                    <div class="col-12 col-lg-8">
                        <div class="blog-posts-area">
                            <?php if ($errors): ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    Заполните поля правильно!
                                </div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    Комментарий успешно добавлен
                                </div>
                            <?php endif; ?>
                            <!-- Post Details Area -->
                            <div class="single-post-details-area">
                                <div class="post-thumbnail mb-30">
                                </div>
                                <div class="post-content">
                                    <h4 class="post-title">Как сделать комментарии?</h4>
                                    <blockquote>
                                        <div class="blockquote-icon">
                                            <img src="img/core-img/quote.png" alt="">
                                        </div>
                                        <div class="blockquote-text">
                                            <h6>Из мыслей человека добывали больше золота, чем когда-либо из недр земли.</h6>
                                            <h6>Наполеон Хилл</h6>
                                        </div>
                                    </blockquote>
                                    <p>Книга: "Думай и богатей". Что вы думаете о данной цитате и саммой книге? Вы читали эту книгу?</p>
                                </div>
                            </div>

                            <!-- Comment Area Start -->
                            <div class="comment_area clearfix">
                                <h4 class="headline"><?= count(getAllComments($pdo)) ?> Комментариев</h4>

                                <ol>
                                    <!-- Single Comment Area -->

                                    <?php foreach (getAllComments($pdo) as $comment): ?>
                                        <li class="single_comment_area">
                                            <div class="comment-wrapper d-flex">
                                                <!-- Comment Meta -->
                                                <div class="comment-author">
                                                    <img src="img/avatar.png" alt="">
                                                </div>
                                                <!-- Comment Content -->
                                                <div class="comment-content">
                                                    <h5><?= $comment->name ?></h5>
                                                    <?= nl2br($comment->body) ?>
                                                    <hr><a href="index.php?delete=<?= $comment->id ?>">Удалить</a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>

                            <!-- Leave A Comment -->
                            <div class="leave-comment-area clearfix">
                                <div class="comment-form">
                                    <h4 class="headline">Оставить комментарий</h4>

                                    <!-- Comment Form -->
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" id="contact-name" placeholder="Имя">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control" id="contact-email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Ваш комментарий"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn foode-btn">Оптравить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ##### Blog Content Area End ##### -->

        <!-- ##### Footer Area Start ##### -->
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Footer Curve Line -->
                        <img class="footer-curve" src="img/core-img/foo-curve.png" alt="">
                        <p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Все права на защите прав! Тут должна быть ссылка на автора, так как её удалять нельзя, ибо лицензия: "CC BY 3.0" 
                        </p>
                        <img class="footer-curve" src="img/core-img/foo-curve.png" alt="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-text">
                            
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ##### Footer Area Start ##### -->

        <!-- ##### All Javascript Script ##### -->
        <!-- jQuery-2.2.4 js -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/bootstrap/popper.min.js"></script>
        <!-- Bootstrap js -->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <!-- All Plugins js -->
        <script src="js/plugins/plugins.js"></script>
        <!-- Active js -->
        <script src="js/active.js"></script>
    </body>

</html>