<section>
<?php
// 	print_r($this->products);
print<<<EOS
	<h2>$this->sectionTitle</h2>
EOS;
	foreach($this->products as $key => $value) {
// 		print_r($key);
		$name=$this->products[$key]['nome'];
		$href=$this->products[$key]['href'];
		$img=$this->products[$key]['img'];
		print<<<EOS
		<section class="product">
			<h3>$name</h3>
			<a href="$href"><img src="$img" alt="$name" /></a>
		</section>
EOS;
	}
	print "	$this->mainDescription\n";
?>
</section>
