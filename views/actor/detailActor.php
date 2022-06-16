<?php
    ob_start();

    if (isset($_GET['id'])){
        $actor = $stateActor->fetch();
        $actorMoviesList = $displayMovie->fetchAll();
    }
    $title= $actor['firstname']. " ". $actor['lastname'];
    
    if (array_key_exists('id_actor', $actor)):
?>

<section id="detail-director">
    <div class="row justify-content-evenly flex-row">
        <div class='col-12'>
            <article class='card mb-4 flex-wrap flex-lg-nowrap justify-content-center'>
                <div class="col-10 col-sm-9 col-md-7 col-lg-4 col-xl-3 text-center">
                    <img class="card-img-top fit-content" src="<?= $actor['poster']?>" alt="<?= "Photo de". $actor['firstname']. " ". $actor['lastname'] ?>">
                    <ul class='justify-content-between pt-4 flex-column text-start align-items-center align-items-lg-start'>
                        <li>
                            <span class='fw-bold'>Nationalité: </span> <?= $actor['nationality']?> 
                        </li>
                        <li>
                            <span class='fw-bold'>Date de naissance: </span> <?= dateToFrench($actor['birthdate']) ?>
                        </li>
                        <li>
                            <span class='fw-bold'>Age: </span> <?= getAge($actor['birthdate'])?>
                        </li>
                        <li>
                            <span class='fw-bold'>Sexe: </span> <?= $actor['gender']?>
                        </li>
                    </ul>
                </div>
                <div class='card-body align-self-center'>
                    <h2 class='card-title mb-4'> <?= $actor['firstname']. " ". $actor['lastname'] ?></h2>
                    <span class='fw-bold d-block pb-3'>Biographie:</span>
                    <p class='card-text'><?= $actor['biography'] ?></p>
                </div>
            </article>
        </div>       
    </div>
    <div class='row justify-content-center justify-content-md-start'>
        <span class='fw-bold pb-3 fs-filmography'>Filmographie:</span>

        <?php foreach ($actorMoviesList as $key => $value):?>
            <div class='col-8 col-sm-6 col-md-4 col-xl-2 img-container adjust-col-xl'>
                <figure>
                    <a href=" index.php?action=detailMovie&id=<?= $actorMoviesList[$key]['id_movie']?>">
                        <img class="img-fluid" src=" <?= $actorMoviesList[$key]['poster']?> " alt=" <?= "Image du film ". $actorMoviesList[$key]['title'] ?>">

                        <figcaption class="text-center"> <?= $actorMoviesList[$key]['title'] ?> </figcaption>
                    </a>
                </figure>
            </div>
        <?php endforeach; ?>

    </div>
    <?php else: header('Location: index.php?action=error'); endif;?>
</section>

<?php
   $content = ob_get_clean();
   require "./views/template.php";
?>