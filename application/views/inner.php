<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WELCOME in <?php echo $this->global_data['site_title']; ?></title>

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
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

     <div class="row">
        <div class="col-lg-12">
			<h1><?php echo $article->title; ?></h1>
			<?php echo $article->body; ?>
        </div>
      </div>

      <div class="footer">
        <p align="center">BLOG CMS 2019 &copy;</p>
      </div>

    </div> <!-- /container -->

  </body>
</html>
