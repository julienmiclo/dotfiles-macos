<?php
include 'functions.php';
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">

  <title>Repositories - WebServer</title>

  <meta name="description" content="">
  <meta name="hostname" content="">
  <meta name="session" content="">

    <?php stylesheets(['normalize', 'master']); ?>
</head>
<body>
<div class="application-main">

  <div class="container margin-big-bottom">
    <div class="row medium-large-full">
      <h1 class="page-title">👋&nbsp;&nbsp;Hello Julien!</h1>
    </div>
  </div>

  <div class="container margin-large-bottom">
    <div class="row medium-large-full">
      <div id="searchContainer" class="search-container relative">
        <label for="searchInput" class="group-field flex flex-middle">
          <span id="searchClear" class="icon clear flex-center-middle"><?php echo get_svg("close"); ?></span>
          <input type="text" id="searchInput" name="searchInput" class="search-input" autofocus autocomplete="false">
          <span class="icon search flex-center-middle"><?php echo get_svg("search"); ?></span>
        </label>
      </div>
    </div>
  </div>

    <?php $repositories = get_repositories(); ?>
    <?php if ($repositories): ?>
      <div class="container">
        <div class="row medium-large-full">
            <?php foreach ($repositories as $repository): ?>
                <?php
                  $date = new DateTime();
                  $date->setTimestamp($repository['last_update_at'])
                ?>
              <a href="<?php echo $repository['url']; ?>" data-name="<?php echo $repository['name']; ?>" class="wrap-repository flex-col">
                <div class="flex-middle margin-medium-bottom">
                  <span class="meta-title"><?php echo $repository['name']; ?></span>
                  <button id="actionBookmark" class="meta-bookmark"><?php echo get_svg('favorite'); ?></button>
                </div>
                <div class="flex-middle">
                  <span class="meta-type <?php echo $repository['type']['class']; ?> flex-middle margin-large-right"><span class="dot"></span> <?php echo $repository['type']['name']; ?></span>
                  <span class="meta-last-update-at">Updated <?php echo $date->format('d M Y'); ?></span>
                </div>
              </a>
            <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
</div>

<?php javascripts(['master']); ?>
</body>
</html>
