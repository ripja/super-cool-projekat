<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <aside>
                <h4>Latest Posts</h4>
                <p>
        <?php

                // pripremamo upit
                $sql = "SELECT * FROM posts ORDER BY posts.created_at";
                $statement = $connection->prepare($sql); // salje upit ka bazi i vraca rezultat

                // izvrsavamo upit
                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $posts = $statement->fetchAll(); // daj nam sve rezultate

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    echo '<pre>';
                    echo '</pre>';

            ?>
            
                <?php
                foreach ($posts as $post) {
            ?>
 
            <div class="blog-post">
                
            <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id'])?>"><?php echo($post['title'])?></a></h2>
            

            </div>
        

            <?php
                }
            ?>
        </p>
        </aside>