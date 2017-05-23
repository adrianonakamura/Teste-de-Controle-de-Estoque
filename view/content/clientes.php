<?php
/**
 * Clientes
 *
 * Website Clientes content
 * @package
 * @name Clientes
 * @author Adriano K. Nakamura<adriano.k.nakamura@gmail.com>
 * @version 0.1
 */
$returnMessage = "";
if (isset($_POST['newClient'])) {

	$clienteNome            = trim($_POST['clientNome']);

	$clientContatoEmail     = trim($_POST['clientContatoEmail']);
	$clientContatoTelefone1 = trim($_POST['clientContatoTelefone1']);

	try {
		$sql = "SELECT 
					cliente_email
				FROM 
					sis_clientes 
				WHERE
					cliente_email = ?;";

		$sth = $dbh->prepare($sql);
		$sth->bindParam(1, $clientContatoEmail, PDO::PARAM_STR);
		$sth->execute();
		$totalRegistros = $sth->rowCount();

		if ($totalRegistros == 0) {

			try {

				$sql = "INSERT INTO sis_clientes (
									cliente_nm, 
									cliente_email, 
									cliente_tel
								) VALUES (
									?,
									?,
									?
								);";

				$sth = $dbh->prepare($sql);
				$sth->bindParam(1, $clienteNome, PDO::PARAM_STR);
				$sth->bindParam(2, $clientContatoEmail, PDO::PARAM_STR);
				$sth->bindParam(3, $clientContatoTelefone1, PDO::PARAM_STR);
				$sth->execute();

				$clientId = $dbh->lastInsertId(); 

			} catch (Exception $e) {
				echo "Error!: " . $e->getMessage() . "<br/>";
				die();
			}

		} else {
			$returnMessage = "<font color='red'>Email já está cadastrado no sistema.</font>";
		}

	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

if (isset($_POST['updateClient'])) {

	$clienteId       = trim($_POST['clienteId']);
	$clienteNome     = trim($_POST['clienteNome']);
	$clienteEmail    = trim($_POST['clienteEmail']);
	$clienteTelefone = trim($_POST['clienteTelefone']);
	$clienteStatus   = trim($_POST['clienteStatus']);

	try {
	
		$sql = "UPDATE sis_clientes SET 
					cliente_nm     = ?, 
					cliente_email  = ?, 
					cliente_tel    = ?, 
					cliente_status = ? 
				WHERE 
					cliente_id = ?;";
					
		$sth = $dbh->prepare($sql);
		$sth->bindParam(1, $clienteNome, PDO::PARAM_STR);
		$sth->bindParam(2, $clienteEmail, PDO::PARAM_STR);
		$sth->bindParam(3, $clienteTelefone, PDO::PARAM_STR);
		$sth->bindParam(4, $clienteStatus, PDO::PARAM_STR);
		$sth->bindParam(5, $clienteId, PDO::PARAM_STR);
		$sth->execute();
		
		
	} catch (PDOException $e) {
		print "Error(UPDATE)!: " . $e->getMessage() . "<br/>";
		die();
	}
}
?>

<div class="panel panel-default">
	<div class="panel-heading">Clientes</div>

	<div class="container-fluid">
		<div class="accordion" id="accordion2">
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
					+ Novo cliente
					</a>
					<?php echo $returnMessage; ?>
				</div>
				<div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
					<div class="accordion-inner">
					
						<form action="clientes" method="post" >
							<input type="hidden" name="newClient" value="newClient" >
							<fieldset>
								<legend>Dados</legend>
								<input type="text" class="input-block-level" size="30" placeholder="Nome" name="clientNome" >
							</fieldset>
							<fieldset>
								<legend>Contato</legend>
								<input type="text" class="input-block-level" size="30" placeholder="E-mail" name="clientContatoEmail" >
								<input type="text" class="input-block-level" size="30" placeholder="Telefone" name="clientContatoTelefone1" >
							</fieldset>
							<button type="submit" class="btn btn-xs btn-success">Adicionar</button>
						</form>
				
						<hr />
					
					</div>
				</div>
			</div>
		</div>
	</div>
	
		<div class="container-fluid">
			<div class="accordion" id="accordion2">
				<div class="accordion-group">

					<table class="table">
						<thead>
							<tr>
								<th>Id. Cliente</th>
								<th>Nm. Cliente</th>
								<th>E-mail</th>
								<th>Telefone</th>
								<th>Dt. Cadastro</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						<?php
						try {
							$sql = "SELECT 
										*, 
										DATE_FORMAT(cliente_registered_dt,'%d/%m/%Y') AS cliente_registered_dt 
									FROM 
										sis_clientes;";

							$sth = $dbh->prepare($sql);
							//$sth->bindValue(1, $_SESSION['clientId'], PDO::PARAM_INT);
							$sth->execute();

							while($row = $sth->fetch()) {
							?>
						<form action="clientes" method="post" >
							<input type="hidden" name="updateClient" value="updateClient" >
							<input type="hidden" name="clienteId" value="<?php echo $row['cliente_id']; ?>" >
							<tr>
								<th>
									<div class="accordion-heading">
											<?php echo $row['cliente_id']; ?>
									</div>
								</th>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="Nome" name="clienteNome" value="<?php echo $row['cliente_nm']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="E-mail" name="clienteEmail" value="<?php echo $row['cliente_email']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="Telefone" name="clienteTelefone" value="<?php echo $row['cliente_tel']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['cliente_registered_dt']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="Status" name="clienteStatus" value="<?php echo $row['cliente_status']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<button type="submit" class="btn btn-xs btn-success">Atualizar</button>
									</div>
								</td>
							</tr>
						</form>
							<?php
							}
						} catch (PDOException $e) {
							print "Error!: " . $e->getMessage() . "<br/>";
							die();
						}
						?>
							
						</tbody>
					</table>

				</div>
			</div>
		</div>
</div>
