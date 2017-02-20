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

$app->post('/alumno', function($request, $response) {

	$result = new AlumnosResult();

	try {

		$input = $request->getParsedBody();

		$statement = $this->db->prepare("INSERT INTO ".TABLE_ALUMNOS."(nombre, apellidos, direccion, ciudad, cp, telefono, email) VALUES(:nombre, :apellidos, :direccion, :ciudad, :cp, :telefono, :email)");
		$statement->bindParam(":nombre", $input['nombre']);
		$statement->bindParam(":apellidos", $input['apellidos']);
		$statement->bindParam(":direccion", $input['direccion']);
		$statement->bindParam(":ciudad", $input['ciudad']);
		$statement->bindParam(":cp", $input['cp']);
		$statement->bindParam(":telefono", $input['telefono']);
		$statement->bindParam(":email", $input['email']);

		$statement->execute();
		$inserted = $statement->rowCount();

		if ($inserted > 0) {
			$result->setCode(200);
			$result->setStatus(OK);
			$result->setInserted($inserted);
		}

	} catch(PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

$app->put('/alumno/[{id}]', function($request, $response, $args) {

	$result = new AlumnosResult();

	try {

		$input = $request->getParsedBody();

		$statement = $this->db->prepare("UPDATE ".TABLE_ALUMNOS." SET nombre = :nombre, apellidos = :apellidos, direccion = :direccion, ciudad = :ciudad, cp = :cp, telefono = :telefono, email = :email WHERE id = :id");
		$statement->bindParam(":nombre", $input['nombre']);
		$statement->bindParam(":apellidos", $input['apellidos']);
		$statement->bindParam(":direccion", $input['direccion']);
		$statement->bindParam(":ciudad", $input['ciudad']);
		$statement->bindParam(":cp", $input['cp']);
		$statement->bindParam(":telefono", $input['telefono']);
		$statement->bindParam(":email", $input['email']);
		$statement->bindParam(":id", $args['id']);

		$statement->execute();
		$updated = $statement->rowCount();

		if ($updated > 0) {
			$result->setCode(200);
			$result->setStatus(OK);
			$result->setUpdated($updated);
		}

	} catch(PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

$app->delete('/alumno/[{id}]', function($request, $response, $args) {

	$result = new AlumnosResult();

	try {

		$input = $request->getParsedBody();

		$statement = $this->db->prepare("DELETE FROM ".TABLE_ALUMNOS." WHERE id = :id");
		$statement->bindParam(":id", $args['id']);

		$statement->execute();
		$deleted = $statement->rowCount();

		if ($deleted > 0) {
			$result->setCode(200);
			$result->setStatus(OK);
			$result->setDeleted($deleted);
		}

	} catch(PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

$app->post('/manager', function($request, $response) {

	$result = new ManagerResult();

	try {

		$input = $request->getParsedBody();

		$statement = $this->db->prepare("INSERT INTO ".TABLE_MANAGER."(fecha, idAlumno, idFalta, idTrabajo, observacion) VALUES(:fecha, :idAlumno, :idFalta, :idTrabajo, :observacion)");
		$statement->bindParam(":fecha", $input['fecha']);
		$statement->bindParam(":idAlumno", $input['idAlumno']);
		$statement->bindParam(":idFalta", $input['idFalta']);
		$statement->bindParam(":idTrabajo", $input['idTrabajo']);
		$statement->bindParam(":observacion", $input['observacion']);

		$statement->execute();
		$inserted = $statement->rowCount();

		if ($inserted > 0) {
			$result->setCode(200);
			$result->setStatus(OK);
			$result->setInserted($inserted);
		}

	} catch(PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

$app->post('/manager/getmng', function($request, $response, $args) {

	$result = new ManagerResult();

	try {
		$input = $request->getParsedBody();

		echo "SELECT * FROM ".TABLE_MANAGER." WHERE fecha = ".$input['fecha'];

		$statement = $this->db->prepare("SELECT * FROM ".TABLE_MANAGER." WHERE fecha = ".$input['fecha']);
		$statement->execute();
		$manager = $statement->fetchColumn();

		$result->setCode(200);
		$result->setStatus(OK);
		$result->setManager($manager);


	} catch (PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

$app->put('/manager/updatemng', function($request, $response, $args) {

	$result = new ManagerResult();

	try {

		$input = $request->getParsedBody();

		$statement = $this->db->prepare("UPDATE ".TABLE_MANAGER." SET idFalta = :idFalta, idTrabajo = :idTrabajo, observacion = :observacion WHERE AND fecha = :fecha");
		$statement->bindParam(":fecha", $input['fecha']);
		$statement->bindParam(":idFalta", $input['idFalta']);
		$statement->bindParam(":idTrabajo", $input['idTrabajo']);
		$statement->bindParam(":observacion", $input['observacion']);

		$statement->execute();
		$updated = $statement->rowCount();

		if ($updated > 0) {
			$result->setCode(200);
			$result->setStatus(OK);
			$result->setUpdated($updated);
		}

	} catch(PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

?>