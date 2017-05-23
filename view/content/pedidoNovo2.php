<?php
$returnMessage = "";

if (isset($_POST['newPedido'])) {
	$clienteId       = trim($_POST['clienteId']);
	$clienteNome     = trim($_POST['clienteNome']);
	$clienteEmail    = trim($_POST['clienteEmail']);
	$clienteTelefone = trim($_POST['clienteTelefone']);
}

if (isset($_POST['newPedido2'])) {

	$produtoQuantidade = trim($_POST['produtoQuantidade']);
	$clienteId         = trim($_POST['clienteId']);
	$produtoId         = trim($_POST['produtoId']);
	
	$clienteNome     = trim($_POST['clienteNome']);
	$clienteEmail    = trim($_POST['clienteEmail']);
	$clienteTelefone = trim($_POST['clienteTelefone']);
	
	try {
		$sql = "SELECT 
					produto_estoque_qt
				FROM 
					sis_produtos
				WHERE 
					produto_id = ?;";

		$sth = $dbh->prepare($sql);
		$sth->bindParam(1, $produtoId, PDO::PARAM_INT);
		$sth->execute();

		while($row = $sth->fetch()) {
			$produtoEstoqueQuantidade = $row['produto_estoque_qt'];
			if ($produtoEstoqueQuantidade >= $produtoQuantidade) {
				
				$novaQuantidadeEstoque = $produtoEstoqueQuantidade - $produtoQuantidade;
				
				try {
				
					$sql = "UPDATE sis_produtos SET 
								produto_estoque_qt = '".$novaQuantidadeEstoque."' 
							WHERE 
								produto_id = '".$produtoId."';";
								
					$sth = $dbh->prepare($sql);
					$sth->execute();
					
					
				} catch (PDOException $e) {
					print "Error(UPDATE)!: " . $e->getMessage() . "<br/>";
					die();
				}
				
				
				try {

					$sql = "INSERT INTO sis_pedidos (
										cliente_id, 
										produto_id, 
										produto_qt
									) VALUES (
										?,
										?,
										?
									);";

					$sth = $dbh->prepare($sql);
					$sth->bindParam(1, $clienteId, PDO::PARAM_STR);
					$sth->bindParam(2, $produtoId, PDO::PARAM_STR);
					$sth->bindParam(3, $produtoQuantidade, PDO::PARAM_STR);
					$sth->execute();

					//$clientId = $dbh->lastInsertId();
					header('Location: '.str_replace($url, "", $_SERVER['REQUEST_URI']).'pedidos');

				} catch (Exception $e) {
					echo "Error!: " . $e->getMessage() . "<br/>";
					die();
				}
				
				
				
			} else {
				$returnMessage = "<font color='red'>Estoque é insuficiente.</font>";
			}
		}
	} catch (PDOException $e) {
		//print "Error(SELECT)!: " . $e->getMessage() . "<br/>";
		//die();
	}

}

echo $returnMessage;
?>

<div class="panel panel-default">
	<div class="panel-heading">Produtos</div>

	<div class="container-fluid">
		<div class="accordion" id="accordion2">
			<div class="accordion-group">

					<div class="accordion-inner">
					
						<form action="produtos" method="post" >
							<input type="hidden" name="newProduct" value="newProduct" >
							<fieldset>
								<legend>Informações do cliente</legend>
								<input type="text" class="input-block-level" size="30" placeholder="Nome" name="produtoNome" value="<?php echo $clienteId; ?>" >
								<input type="text" class="input-block-level" size="30" placeholder="Descrição" name="produtoDescricao" value="<?php echo $clienteNome; ?>" >
								<input type="text" class="input-block-level" size="30" placeholder="Preço" name="produtoPreco" value="<?php echo $clienteEmail; ?>" >
								<input type="text" class="input-block-level" size="30" placeholder="Qtd. Estoque" name="produtoQuantidade" value="<?php echo $clienteTelefone; ?>" >
							</fieldset>
							
						</form>
				
						<hr />

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
								<th>Id. Produto</th>
								<th>Nm. Produto</th>
								<th>Descrição</th>
								<th>Preço</th>
								<th>Estoque</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						<?php
						try {
							$sql = "SELECT 
										*
									FROM 
										sis_produtos
									WHERE 
										produto_status = ?;";

							$sth = $dbh->prepare($sql);
							$sth->bindValue(1, "1", PDO::PARAM_INT);
							$sth->execute();

							while($row = $sth->fetch()) {
							?>

							<tr>
								<th>
									<div class="accordion-heading">
											<?php echo $row['produto_id']; ?>
									</div>
								</th>
								<td>
									<div class="accordion-heading">
											<?php echo $row['produto_nm']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['produto_ds']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['produto_vl']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['produto_estoque_qt']; ?>
									</div>
								</td>
							<form action="pedidoNovo2" method="post" >
								<td>
									<div class="accordion-heading">
										<select name="produtoQuantidade">
											<option value="">Quantidade</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="hidden" name="newPedido2" value="newPedido2" >
										<input type="hidden" name="clienteId" value="<?php echo $clienteId; ?>" >
										<input type="hidden" name="produtoId" value="<?php echo $row['produto_id']; ?>" >
										<input type="hidden" name="clienteNome" value="<?php echo $clienteNome; ?>" >
										<input type="hidden" name="clienteEmail" value="<?php echo $clienteEmail; ?>" >
										<input type="hidden" name="clienteTelefone" value="<?php echo $clienteTelefone; ?>" >
										<button type="submit" class="btn btn-xs btn-success">Adicionar pedido</button>
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
