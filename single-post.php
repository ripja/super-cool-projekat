<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); //veze bazy i php 
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">

</head>

<body>


 
           <?php include('header.php') ?>
    



<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

           
            

            <?php
                if (isset($_GET['post_id'])) {

                    // pripremamo upit
                    $sql = "SELECT * FROM posts WHERE posts.id = {$_GET['post_id']}";

                    $statement = $connection->prepare($sql);

                    // izvrsavamo upit
                    $statement->execute();

                    // zelimo da se rezultat vrati kao asocijativni niz.
                    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                    $statement->setFetchMode(PDO::FETCH_ASSOC);

                    // punimo promenjivu sa rezultatom upita
                    $singlePost = $statement->fetch();

                    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                        
            ?>

                    
            <div class="blog-post">
                       
                            <h1><?php echo $singlePost['title'] ?></h1>
                            <p class="blog-post-meta"><?php echo $singlePost['Created_at']." by " .$singlePost['Author']?><p>
                            <p><?php echo $singlePost['body']?></p> 
                            <br>
                            <br>
                              
                              
                            <br>
                             
                             <br>
            
                
                             <?php

                              
                               // pripremamo upit
                                $sql = "SELECT * FROM comments WHERE post_id = {$_GET['post_id']}";
                                $statement = $connection->prepare($sql); // salje upit ka bazi i vraca rezultat

                                // izvrsavamo upit
                                $statement->execute();

                                // zelimo da se rezultat vrati kao asocijativni niz.
                                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                                $statement->setFetchMode(PDO::FETCH_ASSOC);

                                // punimo promenjivu sa rezultatom upita
                                $comments = $statement->fetchAll(); // daj nam sve rezultate

                                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                                    echo '<pre>';
                                  //  var_dump($comments);
                                    echo '</pre>';


                              ?>
            
                         
            
                <?php
                foreach ($comments as $comment) {
                 ?>
                            
                            <input onclick="change()" type="button" value="Show comments" id="hide-show"></input>
                            
                           
                            <ul id="comments">

                            <!-- zameniti testne komentare sa pravim komentarima koji pripadaju blog post-u iz baze -->
                            <li><hr>
                                <p>posted by:<?php echo $comment['Author']?> </p>
                                <p> <?php echo $comment['Text']?> </p> </hr>
                                
                            </li>
                            </ul>
                          
                        
    
    
 
                     <?php
                             }
                    ?>
           


                            </div>
                     


            <?php
                } else {
                    echo('post_id nije prosledjen kroz $_GET');
                }
            ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->
        <?php include('sidebar.php') ?>

    </div><!-- /.row -->

</main><!-- /.container -->


     <?php include('footer.php') ?>

<script>
/*function change() 
{
    var elem = document.getElementById("hide-show");
    if (elem.value=="Hide comments") elem.value = "Show comments";
    else elem.value = "Hide comments";
}*/

document.getElementById("hide-show").onclick=function(){

        var hideShow = document.getElementById('comments');
        if (hideShow.style.display == '') {
          hideShow.style.display = 'none';
              ;
        }else{
          hideShow.style.display = '';
              
        }

    };
</script>


</body>
</html>