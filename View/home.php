<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>SITE D'ACTUALITE</title>
    <link href="./View/style2.css" rel="stylesheet" />
</head>

<body>
    <h1>ACTUALITES DE L'ESP</h1>
    <div class="container">
        <div class="nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php
                foreach ($categories as $categorie) {
                ?>

                    <li><a href="index.php?cat=<?php echo htmlspecialchars($categorie['id']) ?>"><?php echo htmlspecialchars($categorie['libelle']) ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <?php
    if (isset($articles)) {
        foreach ($articles as $article) {
    ?>
            <div class="card-container">
                <div class="card">
                    <div class=" card-wrapper">
                        <div class="card-title">
                            <h2>
                                <?php echo htmlspecialchars($article['titre']); ?>
                                <em>le <?php echo $article['dateCreation']; ?></em>
                            </h2>
                        </div>
                        <div class="card-content">
                            <p><?php echo nl2br(htmlspecialchars(substr($article['contenu'], 0, 150))); ?></p>
                        </div>
                        <em><a href="index.php?id=<?= urlencode($article['id']) ?>">Lire l'article</a></em>
                    </div>
                </div>

            </div>

        <?php
        }
    } else {
        ?>
        <div class="card-container">
            <div class="card">
                <div class=" card-wrapper">
                    <div class="card-title">
                        <h2>
                            <?php echo htmlspecialchars($article['titre']); ?>
                            <em>le <?php echo $article['dateCreation']; ?></em>
                        </h2>
                    </div>
                    <div class="card-content">
                        <p><?php echo nl2br(htmlspecialchars($article['contenu'])); ?></p>

                        <div align="center" class="pagination">
                            <button class="<?php if ($article['id'] <= 1) {
                                                echo 'disabled';
                                            } ?>">
                                <a href="index.php?id=<?php if ($article['id'] <= 1) {
                                                            echo '1';
                                                        } else {
                                                            echo ($article['id'] - 1);
                                                        } ?>">Prev</a>
                            </button>
                            <button class="<?php if ($article['id'] >= sizeof($articles)) {
                                                echo 'disabled';
                                            } ?>">
                                <a href="index.php?id=<?php if ($article['id'] >=sizeof($articles)) {
                                                            echo $article['id'];
                                                        } else {
                                                            echo ($article['id'] + 1);
                                                        } ?>">Next</a>
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>



    <?php
    }
    ?>


</body>

</html>