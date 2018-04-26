<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">MyBookList</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php print $route == 'home' || '' ? 'active' : '' ?>">
        <a class="nav-link" href="/home">Home</a>
      </li>
      <li class="nav-item <?php print $route == 'book-search' ? 'active' : '' ?>">
        <a class="nav-link" href="/book-search">Book Search</a>
      </li>
      <li class="nav-item <?php print $route == 'user-search' ? 'active' : '' ?>">
        <a class="nav-link" href="/user-search">User Search</a>
      </li>
      <li class="nav-item <?php print $route == 'book-list' ? 'active' : '' ?>">
        <a class="nav-link" href="<?php print $user ? '/book-list?user=' . $user->username : '/login'?>">Book List</a>
      </li>
      <li class="nav-item <?php print $route == 'profile' ? 'active' : '' ?>">
        <a class="nav-link" href="<?php print $user ? '/profile?user=' . $user->username : '/login'?>">Profile</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="login" method="POST">
      <input type="hidden" name="action" value="<?php print ($user ? 'logout' : 'login') ?>">
      <input type="hidden" name="redirect" value="<?php print ($route ? $route : '') ?>">
      <input type="submit" class="btn btn-md <?php print ($user ? 'btn-danger' : 'btn-success') ?>" value="<?php print ($user ? 'Logout' : 'Login') ?>">
    </form>
  </div>
</nav>
