<?php

require_once('phpmailer524/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

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

$app->get('/alumno/[{id}]', function($request, $response, $args) {

	$result = new AlumnosResult();

	try {

		$statement = $this->db->prepare("SELECT * FROM ".TABLE_ALUMNOS." WHERE id = ".$args['id']);
		$statement->execute();
		$alumnos = $statement->fetch();

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

$app->post('/managers', function($request, $response) {

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

$app->get('/managers', function($request, $response) {

	$result = new ManagerResult();

	try {
		$statement = $this->db->prepare("SELECT * FROM ".TABLE_MANAGER);
		$statement->execute();
		$manager = $statement->fetchAll();

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


$app->get('/manager[/{fecha}[/{id}]]', function($request, $response, $args) {

	$result = new ManagerResult();

	try {

		if ($args['id'] == "") {
			$statement = $this->db->prepare("SELECT * FROM ".TABLE_MANAGER." WHERE fecha = \"".$args['fecha']."\"");
		} else {
			$statement = $this->db->prepare("SELECT * FROM ".TABLE_MANAGER." WHERE idAlumno = ".$args['id']." AND fecha = \"".$args['fecha']."\"");
		}
		
		$statement->execute();
		$manager = $statement->fetchAll();

		$result->setCode(200);
		$result->setStatus(OK);
		$result->setRequestedStudent($args['id']);
		$result->setManager($manager);


	} catch (PDOException $e) {
		$result->setCode(300);
		$result->setStatus(CONFLICT);
		$result->setMessage("Error: ".$e->getMessage());
	}

	return $this->response->withJson($result);
});

$app->put('/manager/[{idAlumno}]', function($request, $response, $args) {

	$result = new ManagerResult();

	try {

		$input = $request->getParsedBody();

		$sql = "UPDATE ".TABLE_MANAGER." SET idFalta = ".$input['idFalta'].", idTrabajo = ".$input['idTrabajo'].", observacion = \"".$input['observacion']."\" WHERE idAlumno = ".$args['idAlumno']." AND fecha = \"".$input['fecha']."\"";
		$result->setSql($sql);

		$statement = $this->db->prepare($sql);
		
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

$app->post('/email', function($request, $response, $args) {
	/*
	$result = new EmailResult();

	$input = $request->getParsedBody();

	$from = FROM;
	$password = PASSWORD;

	$result->setAddress(FROM);
	$result->setPassword(PASSWORD);

	$to = $input['address'];
	$subject = $input['subject'];
	$message = $input['message'];
	$mail = new PHPMailer(true);
	// the true param means it will throw exceptions on errors, which we need to catch
	$mail->IsSMTP(); // telling the class to use SMTP

	try {
	 //$mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
	 $mail->SMTPDebug = 0;
	 $mail->SMTPAuth = true; // enable SMTP authentication
	 $mail->SMTPSecure = "tls"; // sets the prefix to the server
	 $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	 //$mail->Host = "smtp.openmailbox.org";
	 $mail->Port = 587; // set the SMTP port for the GMAIL server
	 $mail->Username = $from; // GMAIL username
	 $mail->Password = $password; // GMAIL password
	 $mail->AddAddress($to); // Receiver email
	 $mail->SetFrom($from, 'David Primenko'); // email sender
	 $mail->AddReplyTo($from, 'David Primenko'); // email to reply
	 $mail->Subject = $subject; // subject of the message
	 $mail->AltBody = 'Message in plain text'; // optional - MsgHTML will create an alternate automatically
	 $mail->MsgHTML($message); // message in the email
	 //$mail->AddAttachment('images/phpmailer.gif'); // attachment
	 $mail->Send();
	 $result->setMessage("Message Sent OK to " . $to);
	} catch (phpmailerException $e) {
	 //echo $e->errorMessage(); //Pretty error messages from PHPMailer
	 $result->setMessage("Error: " . $e->errorMessage());
	} catch (Exception $e) {
	 //echo $e->getMessage(); //Boring error messages from anything else!
	 $result->setMessage("Error: " . $e->getMessage());	 
	}

	return $this->response->withJson($result);*/

	//Create a new PHPMailer instance
$result = new EmailResult();

$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "davidruso47@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "david4769";
//Set who the message is to be sent from
$mail->setFrom('davidruso47@gmail.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('davidruso6@gmail.com', 'David Primenko');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
	if (!$mail->send()) {
	    $result->setMessage("Error");
	} else {
	    $result->setMessage("Message Sent OK");
	}	
});

return $this->response->withJson($result);

?>