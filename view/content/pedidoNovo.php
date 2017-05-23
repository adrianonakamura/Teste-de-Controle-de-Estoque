<?php
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
?>

<div class="panel panel-default">
	<div class="panel-heading">Novo Pedido</div>

	<div class="container-fluid">
		<div class="accordion" id="accordion2">
			<div class="accordion-group">
				<div class="accordion-heading">
					Selecione um cliente para realizar o pedido.
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

							<tr>
								<th>
									<div class="accordion-heading">
											<?php echo $row['cliente_id']; ?>
									</div>
								</th>
								<td>
									<div class="accordion-heading">
											<?php echo $row['cliente_nm']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['cliente_email']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['cliente_tel']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<form action="pedidoNovo2" method="post" >
											<input type="hidden" name="newPedido" value="newPedido" >
											<input type="hidden" name="clienteId" value="<?php echo $row['cliente_id']; ?>" >
											<input type="hidden" name="clienteNome" value="<?php echo $row['cliente_nm']; ?>" >
											<input type="hidden" name="clienteEmail" value="<?php echo $row['cliente_email']; ?>" >
											<input type="hidden" name="clienteTelefone" value="<?php echo $row['cliente_tel']; ?>" >
											<button type="submit" class="btn btn-xs btn-success">Adicionar</button>
										</form>
									</div>
								</td>
							</tr>
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
