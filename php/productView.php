<section>
<?php
// 	print_r($this->products);
print<<<EOS
	<h2>$this->sectionTitle</h2>
EOS;
	foreach($this->subProducts as $key => $value) {
// 		print_r($key);
		$name=$this->subProducts[$key]['nome'];
		$href=$this->subProducts[$key]['href'];
		$img=$this->subProducts[$key]['img'];
		print<<<EOS
		<section class="product">
			<h3>$name</h3>
			<a href="$href"><img src="$img" alt="$name" /></a>
		</section>
EOS;
	}
	print "	$this->productDescription\n";
?>
</section>
