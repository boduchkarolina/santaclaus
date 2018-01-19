<nav class="row">
  <div class="container-fluid">
    <div class="nav">
      <ul class="nav nav-pills">
        <li role="presentation" class='<?php if($GLOBALS['active']=='children_list') echo 'active'; ?>'><a href="children_list.php">Grzeczne dzieci</a></li>
        <li role="presentation" class='<?php if($GLOBALS['active']=='add') echo 'active'; ?>'><a href="add.php">Dodaj nowe Dziecko</a></li>
        <li role="presentation" ><a href="logout.php">Wyloguj</a></li>
      </ul>
    </div>
  </div>
</nav>
