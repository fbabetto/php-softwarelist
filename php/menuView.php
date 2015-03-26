	<ul>
		<?php
			foreach($this->links as $key => $value) {
				if($value['href']) {
					print "	<li><a href=\"$value[href]\">$value[a]</a>\n";
				}
				else {
					print "	<li>$value[a]\n";
				}
				if(array_key_exists('prodotti', $value)) {
					print "	<ul>\n";
					foreach($value['prodotti'] as $kp => $vp) {
						if($vp['href']) {
							print "		<li><a href=\"$vp[href]\">$vp[a]</a>\n";
						}
						else {
							print "		<li>$vp[a]\n";
						}
						if(array_key_exists('sottoprodotti', $vp)) {
							print "		<ul>\n";
							foreach($vp['sottoprodotti'] as $ksp => $vsp) {
								if($vsp['href']) {
									print "			<li><a href=\"$vsp[href]\">$vsp[a]</a></li>\n";
								}
								else {
									print "			<li>$vsp[a]</li>\n";
								}
							}
							print "		</ul>\n";
						}
						print "		</li>\n";
					}
					print "	</ul>\n";
				}
				print "	</li>\n";
			}
		?>
	</ul>