<?php

/**
 * Template Name: single-photographie
 * Template Post Type: projet
 
 */

get_header();
?>

<section class="single-projet">

    <?php if (have_posts()) :
        while (have_posts()) :
            the_post();

            // *****Récupération des valeurs de champ ACF ***  
            // Récupérer l'ID du custom post type 
            $projet_id = get_the_ID();
            //  Récupérer les valeurs des champs  
            $objectif = get_post_meta($projet_id, 'objectif', true);
            $realisation = get_post_meta($projet_id, 'mission', true);
            $contrainte = get_post_meta($projet_id, 'contraintes_techniques', true);
            $lienGitHub = get_field('github');
            $pointTech = get_post_meta($projet_id, 'point-tech', true);
            $solutionTech = get_post_meta($projet_id, 'solution-tech', true);
            $video = get_post_meta($projet_id, 'video', true);
            $pointResolu = get_post_meta($projet_id, 'point-resolu', true);


            // Récupérer le titre du custom post type
            $post_title = get_the_title();

            echo '<article class="projet-header">
                    <div class="left-col">';
            echo '<h2 class="projet-title">' . $post_title . '</h2>';
            echo    '<h4 class="objectif">' . $objectif . '</h4>
                    </div>';
    ?>
              <aside class="projet-photo">
                <!-- Afficher le texte alternatif de la photographie -->
                <?php $photo_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);  ?>
                <img class="img-box" src="<?php the_post_thumbnail_url();  ?>" alt="<?php echo $photo_alt; ?>">
              </aside>
            </article>

            <article class="def-projet">
                <?php
                echo   '<div class="row-1-">
                            <div class="col-right"><h4>Mission</h4>';
                echo      '<p class="realisation">' . $realisation . '</p></div>';
              // Affichage de la composition d'image
                $compoImage = get_field( 'compo-image');
                if (!empty($compoImage)):
                  echo    '<img class="compo img-box" src="'.$compoImage['url'].'" alt="image extraite du site">
                        </div>';
                endif;
                
                echo    '<div class="row-2">
                          <div>  <h4>Contraintes</h4>';
                echo      '<p class="contrainte">' . $contrainte . '</p></div>';

                     

                // Affichage vidéo
                if(!empty($video)) {
                  echo    '<video class="light-box" width= "450" autoplay muted loop src="'.$video.'"></video>';
                };
                echo '</div>';
                if (!empty($pointTech)):
                echo    '<div class="parag"><p>Point technique à résoudre:<br>
                        '.$pointTech.'</p>';
                endif;        
                if (!empty($solutionTech)):
                echo    '<p>Solution apportée:<br>
                        '.$solutionTech.'</p></div>';  
                endif;
                echo '</article>';
                echo '<article class="techno">';
                // affichage side image vue mobile
                $sideImage = get_field('side-image');
                if (!empty($sideImage)):
                  echo    '<div class="side-image light-box"> 
                  <label for="sideImage">Vue de la page d accueil:</label> <img id="sideImage"src="'.$sideImage['url'].'" alt="vue mobile de la page d accueil">
                    </div>';
                endif;

                echo '<div class="col-right" ><h4>Tehnologies utilisés</h4>';
                $types = get_post_meta($projet_id, 'technologies', true);
                if (is_array($types)) {
                  foreach ($types as $key => $value) {
                    echo '<p class="box-text light-box">'. $value . '</p>';
                  };   
                };
                if (!empty($lienGitHub)) {
                  echo '<a href="' .$lienGitHub . '"><img class="logo-box hover" src="'.get_stylesheet_directory_uri().'/images/Github-logo.svg.png" alt="logo gitHub"></a>';
                }
                echo '</div>';

            echo '</article>';
            ?>
</section>
<?php
 	 endwhile; // End of the loop. 
	endif;   
	
//  get_sidebar();
 get_footer();
 ?>