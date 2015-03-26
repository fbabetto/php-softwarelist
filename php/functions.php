<?php
	function generaDescrizionePrincipale($idPrincipale, $categoriaProdotti) {
		$categories = array();
		foreach($categoriaProdotti as $key => $value) {
			if($key != $idPrincipale) {
				$categories[$key]['nome']=$categoriaProdotti[$key]['nome'];
				$categories[$key]['href']="software.php?id=$key";
				$nomeCategoria=$categoriaProdotti[$key]['nome'];
				$categories[$key]['img']="img/software/$nomeCategoria.jpg";
			}
		}
		return $categories;
	}

	function generaDescrizioneCategoria($idCategoria, $categoriaProdotti) {
		$products = array();
		foreach($categoriaProdotti as $key => $value) {
			if($key === $idCategoria) {
// 			print_r($key);
				$prodotti=$categoriaProdotti[$key]['prodotti'];
				foreach($prodotti as $k => $v) {
					$products[$k]=array();
					$products[$k]['nome']=$prodotti[$k]['nome'];
					$products[$k]['href']="software.php?id=$k";
					$nomeProdotto=$products[$k]['nome'];
					$products[$k]['img']="img/software/$nomeProdotto.jpg";
				}
			}
		}
// 		print_r($products);
		return $products;
	}
	//FIXME THIS FUNCTION SEARCH AFTER HAVING FOUND THE CORRECT KEY (INSTEAD OF EXITING FROM THE LOOP)
	
	function generaDescrizioneProdotto($idProdotto, $categoriaProdotti) {
// 	print_r($categoriaProdotti);
		$subproducts = array();
		foreach($categoriaProdotti as $key => $value) {
// 			print_r($key);
			if(array_key_exists('prodotti', $categoriaProdotti[$key]))
			{
				$prodotti=$categoriaProdotti[$key]['prodotti'];
				foreach($prodotti as $k => $v) {
					if($k === $idProdotto) {
						$sottoProdotti=$categoriaProdotti[$key]['prodotti'][$k]['sottoprodotti'];
// 						print_r($sottoProdotti);
						foreach($sottoProdotti as $sk => $sv)
						{
							$subproducts[$sk]=array();
							$subproducts[$sk]['nome']=$sottoProdotti[$sk]['nome'];
							$subproducts[$sk]['href']="software.php?id=$sk";
							$nomeSottoProdotto=$subproducts[$sk]['nome'];
							$subproducts[$sk]['img']="img/software/$nomeSottoProdotto.jpg";
						}
					}
				}
			}
		}
		return $subproducts;
	}
	//FIXME SAME HERE
?>
