<?php

include_once 'php/Template.php';
include_once 'php/functions.php';

$xmlFilePath='products.xml';

if (file_exists($xmlFilePath)) {
    $xml = simplexml_load_file($xmlFilePath);
} else {
    die("Failed to open $xmlFilePath.\n");
}

$id=null;
if($_GET != null && array_key_exists('id', $_GET)) {
	$id=htmlspecialchars($_GET['id']);
}

// descrizione del prodotto corrente
$descrizione;
// array delle categorie, prodotti e sottoprodotti
$categoriaProdotti=array();
// ciclo per popolare il suddetto array con solo id e nome e sapere tipo dell'id corrente (categoria/prodotto/sottoprodotto)
$tipoCorrente='nessuno';
$vuoto=true;

foreach($xml->categoria as $categoria) {
	$id_c=strval($categoria->attributes()->id);
	$cat=strval($categoria->nome);
	$categoriaProdotti[$id_c]=array(
		'nome' => $cat,
	);
	if($id && $id===$id_c) {
		$tipoCorrente='categoria';
	}
	if(array_key_exists('prodotto', $categoria)) {
		if($id && $id===$id_c) {
			$vuoto=false;
		}
		$prodotti=array();
		foreach($categoria->prodotto as $prodotto) {
			$id_p=strval($prodotto->attributes()->id);
			$nome=strval($prodotto->nome);
			$pr=array(
				'nome' => $nome,
			);
			if($id && $id===$id_p) {
				$tipoCorrente='prodotto';
			}
			if(array_key_exists('sottoprodotto', $prodotto)) {
				if($id && $id===$id_p) {
					$vuoto=false;
				}
				$sottoprodotti=array();
				foreach($prodotto->sottoprodotto as $sottoprodotto) {
					$id_s=strval($sottoprodotto->attributes()->id);
					$nome_s=strval($sottoprodotto->nome);
					$spr=array(
						'nome'=>$nome_s,
					);
					$sottoprodotti[$id_s]=$spr;
					if($id && $id===$id_s) {
						$tipoCorrente='sottoprodotto';
					}
				}
				$pr['sottoprodotti']=$sottoprodotti;
			}
			$prodotti[$id_p]=$pr;
		}
		$categoriaProdotti[$id_c]['prodotti']=$prodotti;
	}
}

// print_r($categoriaProdotti);
// echo $tipoCorrente;
// echo $vuoto;


// array dei link delle pagine
$links=array();
$h='software.php?id=';
// ciclo per popolare l'array $links con tutti  link (href) e il loro nome del link
// in caso il link sia alla pagina corrente, href sarà nullo
foreach($categoriaProdotti as $id_c => $value) {
	if($id_c != $id) {
		$href=$h.$id_c;
	}
	else {
		$href=null;
	}
	$a=$value['nome'];
	$links[$id_c]=array(
		'href' => $href,
		'a' => $a,
	);
	if(array_key_exists('prodotti', $value)) {
		$prodotti=array();
		foreach($value['prodotti'] as $id_p => $v_p) {
			if($id_p != $id) {
				$href=$h.$id_p;
			}
			else {
				$href=null;
			}
			$a=$v_p['nome'];
			$pr=array(
				'href' => $href,
				'a' => $a,
			);
			if(array_key_exists('sottoprodotti', $v_p)) {
				$sottoprodotti=array();
				foreach($v_p['sottoprodotti'] as $id_sp => $v_sp) {
					if($id_sp != $id) {
						$href=$h.$id_sp;
					}
					else {
						$href=null;
					}
					
					$a=$v_sp['nome'];
					$spr=array(
						'href' => $href,
						'a' => $a,
					);
					$sottoprodotti[$id_sp]=$spr;
				}
				$pr['sottoprodotti']=$sottoprodotti;
			}
			$prodotti[$id_p]=$pr;
		}
		$links[$id_c]['prodotti']=$prodotti;
	}
}

// print_r($links);

if($_GET != null && array_key_exists('id', $_GET)) {
	//cerco la descrizione relativa a quell'id nel file xml
	$descrizione = strval($xml->xpath("//categoria[@id='$id']/descrizione | //prodotto[@id='$id']/descrizione | //sottoprodotto[@id='$id']/descrizione")[0]);

	// cerco il nome relativo a quell'id nel file xml
	$nome=strval($xml->xpath("//categoria[@id='$id']/nome | //prodotto[@id='$id']/nome | //sottoprodotto[@id='$id']/nome")[0]);

	
	if($id==='000000') {
		$products=generaDescrizionePrincipale($id, $categoriaProdotti);
		$main = new Template('mainView.php', array(
			'title' => 'Software', 
			'leftMenu' => new Template('menuView.php', array('links' => $links, 'pagina_corrente' => "software.php?id=$id")),
			'productContent' => new Template('mainCategoryView.php', array('sectionTitle' => $nome, 'mainDescription' => $descrizione, 'products' => $products))
			));
	}
	elseif($tipoCorrente==='categoria' && $vuoto===false) {
		$products=generaDescrizioneCategoria($id, $categoriaProdotti);
		$main = new Template('mainView.php', array(
			'title' => 'Software', 
			'leftMenu' => new Template('menuView.php', array('links' => $links, 'pagina_corrente' => "software.php?id=$id")),
			'productContent' => new Template('categoryView.php', array('sectionTitle' => $nome, 'categoryDescription' => $descrizione, 'products' => $products))
			));
	}
	elseif($tipoCorrente==='prodotto' && $vuoto===false) {
			$subProducts=(generaDescrizioneProdotto($id, $categoriaProdotti));
			$main = new Template('mainView.php', array(
			'title' => 'Software', 
			'leftMenu' => new Template('menuView.php', array('links' => $links, 'pagina_corrente' => "software.php?id=$id")),
			'productContent' => new Template('productView.php', array('sectionTitle' => $nome, 'productDescription' => $descrizione, 'subProducts' => $subProducts))));
	}
	else {
			$main = new Template('mainView.php', array(
			'title' => 'Software', 
			'leftMenu' => new Template('menuView.php', array('links' => $links, 'pagina_corrente' => "software.php?id=$id")),
			'productContent' => new Template('contentView.php', array('sectionTitle' => $nome, 'content' => $descrizione)),
		));
	}
}
else {
	header("location: software.php?id=000000");
}

$main->render();
?>