<?php
function dbConnect()
{
	try {
		$database = new PDO('mysql:host=localhost;dbname=mglsi_news;charset=utf8', 'root', '');
		// $database = new PDO('mysql:host=192.168.43.81;port=8889;dbname=mglsi_news;charset=utf8', 'mglsi_user', 'passer');

		return $database;
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
}

function getArticles($cat = "")
{
	// connexion à la base de données
	$database = dbConnect();

	if (strlen($cat) > 0) {

		$statement = $database->query(
			"SELECT * FROM article where category_id=$cat ORDER BY date_Modification DESC"
		);

	} else {
		$statement = $database->query(
			"SELECT * FROM article ORDER BY date_Modification DESC "
		);
	}
	// Recuperer les articles
	$articles = [];
	while (($row = $statement->fetch())) {
		$article = [
			'id' => $row['id'],
			'titre' => $row['titre'],
			'dateCreation' => $row['date_creation'],
			'dateModification' => $row['date_modification'],
			'contenu' => $row['contenu'],
			'categorie' => $row['category_id'],
		];

		$articles[] = $article;
	}

	return $articles;
}
function getArticle($id)
{
	$database = dbConnect();

	$statement = $database->prepare(
		"SELECT id, titre, contenu, DATE_FORMAT(date_Creation, '%d/%m/%Y à %Hh%imin%ss') AS dateCreation FROM article WHERE id = ?"
	);
	$statement->execute([$id]);

	$row = $statement->fetch();
	$article = [
		'id' => $row['id'],
		'titre' => $row['titre'],
		'dateCreation' => $row['dateCreation'],
		'contenu' => $row['contenu'],
	];

	// print '<pre>';
	// var_dump($article);
	// print '</pre>';

	return $article;
}

function getCategories()
{
	$database = dbConnect();

	$statement = $database->query(
		"SELECT * FROM category"
	);
	$categories = [];
	while (($row = $statement->fetch())) {
		$categorie = [
			'id' => $row['id'],
			'libelle' => $row['libelle'],
		];

		$categories[] = $categorie;
	}

	return $categories;
}

function getCategorie($id)
{
	$database = dbConnect();

	$statement = $database->query(
		"SELECT * FROM article where category_id= $id ORDER BY date_Modification DESC"
	);
	while (($row = $statement->fetch())) {
		$article = [
			'id' => $row['id'],
			'titre' => $row['titre'],
			'dateCreation' => $row['date_creation'],
			'dateModification' => $row['date_modification'],
			'contenu' => $row['contenu'],
			'categorie' => $row['category_id'],
		];

		$articles[] = $article;
	}
}
