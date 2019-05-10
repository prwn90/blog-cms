<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WELCOME in <?php echo $this->global_data['site_title']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/jumbotron-narrow.css" rel="stylesheet">

  </head>

  <body>

   
    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <?php foreach($menu_items as $item) : ?>
            <li><a href="<?php echo base_url(); ?>articles/view/<?php echo $item->id; ?>"><?php echo $item->title; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <h3 class="text-muted"><img src="<?php echo base_url(); ?>assets/images/<?php echo $this->global_data['logo']; ?>" alt="<?php echo $this->global_data['site_title']; ?>" /></h3>
      </div>

      <div class="jumbotron">
        <h1><?php echo $this->global_data['jumbotron_heading']; ?></h1>
        <p class="lead"><?php echo $this->global_data['jumbotron_text']; ?></p>
        <p><a class="btn btn-lg btn-warning" href="<?php echo $this->global_data['jumbotron_button_link']; ?>" role="button"><?php echo $this->global_data['jumbotron_button_text']; ?></a></p>
      </div>

      <ul class="home-content">
    <?php foreach($articles as $article) : ?>
      <li>
      <h4><?php echo $article->title; ?></h4>
        <?php echo word_limiter($article->body, 20); ?>
        <p><a href="<?php echo base_url(); ?>articles/view/<?php echo $article->id; ?>">More</a></p>
      </li>
    <?php endforeach; ?>
  </ul>

      <div class="footer">
        <p align="center"> BLOG CMS 2019 &copy;</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
