<?php

$app->get('/', function($request,$response) {
	$welcome = '
	<html>
		<head>
			<meta charset="utf8" />
			<title>API Cuaderno - David Primenko</title>
		</head>
		<body>
			<h1>API Cuaderno - David Primenko</h1>
			<p>Api que brinda información de la clase</p>
		</body>
	</html>
	';

	$body = $response->getBody();
	$body->write($welcome);
});

$app->get('/alumnos', function($request, $response) {

	$result = new AlumnosResult();

	try {

		$statement = $this->db->prepare("SELECT * FROM ".TABLE_ALUMNOS);
		$statement->execute();
		$alumnos = $statement->fetchAll();

		$result->setCode(200);
		$result->setStatus(OK);
		$result->setAlumnos($alumnos);


	} catch (PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

?>