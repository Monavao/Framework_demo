<?= $renderer->render('header'); ?>
<br><br>
<h1>Bienvenue sur le blog!!!</h1>

<ul>
  <li><a href="<?= $router->generateUri('blog.show', ['slug' => 'drgrgrg4444-rvrvrv']); ?>">Article 1</a></li>
  <li>Article 2</li>
  <li>Article 3</li>
  <li>Article 4</li>
  <li>Article 5</li>
  <li>Article 6</li>
</ul>
<?= $renderer->render('footer'); ?>
