<?php

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