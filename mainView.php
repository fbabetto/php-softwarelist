<!DOCTYPE html>

<html lang="it">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Software</title>
  </head>
  
  <body>
  
    <header>
            <p>This is the main header</p>
    </header>
    
    <nav> <!-- this is the main menu -->
      <ul>
		<li><a href="index.html" xml:lang="en" tabindex="1" title="Accesskey: 1" accesskey="1">Home</a></li>
		<li class="active"><span xml:lang="en">Software</span></li>
		<li><a href="another.html">Another page</a></li>
      </ul>
    </nav>
    
    <section id="main" class="software">
		<h1><?php echo $this->title ?></h1>
	 <aside><?php $this->leftMenu->render(); ?></aside> <!-- this is the left menu -->
			<section class="assistenza"><!-- this is a floating box visible in every page -->
				For more information send an email to
				<img src="img/icons/assistenza.png" />
				<ul>
					<li>TEST</li>
				</ul>
			</section>
	 <article><?php $this->productContent->render(); ?></article><!-- Main content -->
    </section>

    
    <footer>
      <p>Footer content here.</p>
      <p>Icons from <a class="external" href="http://commons.wikimedia.org/wiki/Tango_icons">"Tango" project</a> - 
      External link icon from <a class="external" href="http://commons.wikimedia.org/wiki/File:Icon_External_Link.svg">Wikimedia Commons</a></p>
    </footer>
    
  </body>
  
</html> 
