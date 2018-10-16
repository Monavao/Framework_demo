<?= $renderer->render('header', ['title' => $slug]); ?>
    <br><br>
    <h1>Bienvenue sur l'article <?= $slug; ?></h1>
<?= $renderer->render('footer'); ?>