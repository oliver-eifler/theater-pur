<?php
$this->created = 1467475900;
$this->modified = 1468081837;
$this->title = "Page not found";
?>
<?= Component::get("inlineCSS","css/404.css") ?> <div class="error"><img src="/images/yawn.png" alt="404"><h1 class="error-big">Page Not Found</h1><p><strong>Sorry, but the page you were trying to view does not exist.</strong></p><p>Maybe, you try it here:</p><?= Component::get("MainMenu") ?></div>