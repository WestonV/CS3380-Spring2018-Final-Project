<nav>
  <form action="login" method="POST">
    <input type="hidden" name="action" value="<?php print ($user ? 'logout' : 'login') ?>">
    <input type="hidden" name="redirect" value="<?php print ($route ? $route : '') ?>">
    <input type="submit" value="<?php print ($user ? 'logout' : 'login') ?>">
  </form>
</nav>
