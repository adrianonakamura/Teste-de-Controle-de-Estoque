<?php
/**
 * Produtos
 *
 * Website Produtos content
 * @package
 * @name Produtos
 * @author Adriano K. Nakamura<adriano.k.nakamura@gmail.com>
 * @version 0.1
 */
$returnMessage = "";
if (isset($_POST['newProduct'])) {

	$produtoNome       = trim($_POST['produtoNome']);
	$produtoDescricao  = trim($_POST['produtoDescricao']);
	$produtoPreco      = trim($_POST['produtoPreco']);
	$produtoQuantidade = trim($_POST['produtoQuantidade']);

	try {
		$sql = "SELECT 
					produto_nm
				FROM 
					sis_produtos 
				WHERE
					produto_nm = ?;";

		$sth = $dbh->prepare($sql);
		$sth->bindParam(1, $produtoNome, PDO::PARAM_STR);
		$sth->execute();
		$totalRegistros = $sth->rowCount();

		if ($totalRegistros == 0) {

			try {

				$sql = "INSERT INTO sis_produtos (
									produto_nm, 
									produto_ds, 
									produto_vl, 
									produto_estoque_qt
								) VALUES (
									?,
									?,
									?,
									?
								);";

				$sth = $dbh->prepare($sql);
				$sth->bindParam(1, $produtoNome, PDO::PARAM_STR);
				$sth->bindParam(2, $produtoDescricao, PDO::PARAM_STR);
				$sth->bindParam(3, $produtoPreco, PDO::PARAM_STR);
				$sth->bindParam(4, $produtoQuantidade, PDO::PARAM_STR);
				$sth->execute();

				$clientId = $dbh->lastInsertId(); 

			} catch (Exception $e) {
				echo "Error!: " . $e->getMessage() . "<br/>";
				die();
			}

		} else {
			$returnMessage = "<font color='red'>Já existe um produto com este nome.</font>";
		}

	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

if (isset($_POST['updateProduct'])) {

	$produtoId         = trim($_POST['produtoId']);
	$produtoNome       = trim($_POST['produtoNome']);
	$produtoDescricao  = trim($_POST['produtoDescricao']);
	$produtoPreco      = trim($_POST['produtoPreco']);
	$produtoQuantidade = trim($_POST['produtoQuantidade']);
	$produtoStatus     = trim($_POST['produtoStatus']);

	try {
	
		$sql = "UPDATE sis_produtos SET 
					produto_nm         = ?, 
					produto_ds         = ?, 
					produto_vl         = ?, 
					produto_estoque_qt = ?, 
					produto_status     = ? 
				WHERE 
					produto_id = ?;";
					
		$sth = $dbh->prepare($sql);
		$sth->bindParam(1, $produtoNome, PDO::PARAM_STR);
		$sth->bindParam(2, $produtoDescricao, PDO::PARAM_STR);
		$sth->bindParam(3, $produtoPreco, PDO::PARAM_STR);
		$sth->bindParam(4, $produtoQuantidade, PDO::PARAM_STR);
		$sth->bindParam(5, $produtoStatus, PDO::PARAM_STR);
		$sth->bindParam(6, $produtoId, PDO::PARAM_INT);
		$sth->execute();

	} catch (PDOException $e) {
		print "Error(UPDATE)!: " . $e->getMessage() . "<br/>";
		die();
	}
}
?>

<div class="panel panel-default">
	<div class="panel-heading">Produtos</div>

	<div class="container-fluid">
		<div class="accordion" id="accordion2">
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
					+ Novo produto
					</a>
					<?php echo $returnMessage; ?>
				</div>
				<div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
					<div class="accordion-inner">
					
						<form action="produtos" method="post" >
							<input type="hidden" name="newProduct" value="newProduct" >
							<fieldset>
								<legend>Informações do produto</legend>
								<input type="text" class="input-block-level" size="30" placeholder="Nome" name="produtoNome" >
								<input type="text" class="input-block-level" size="30" placeholder="Descrição" name="produtoDescricao" >
								<input type="text" class="input-block-level" size="30" placeholder="Preço" name="produtoPreco" >
								<input type="text" class="input-block-level" size="30" placeholder="Qtd. Estoque" name="produtoQuantidade" >
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
						<form action="produtos" method="post" >
							<input type="hidden" name="updateProduct" value="updateProduct" >
							<input type="hidden" name="produtoId" value="<?php echo $row['produto_id']; ?>" >
							<tr>
								<th>
									<div class="accordion-heading">
											<?php echo $row['produto_id']; ?>
									</div>
								</th>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="Nome do produto" name="produtoNome" value="<?php echo $row['produto_nm']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="Descrição do produto" name="produtoDescricao" value="<?php echo $row['produto_ds']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" size="10" placeholder="Preço" name="produtoPreco" value="<?php echo number_format($row['produto_vl'],2,',','.'); ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" size="5" placeholder="Quantidade do produto" name="produtoQuantidade" value="<?php echo $row['produto_estoque_qt']; ?>">
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<input type="text" class="input-block-level" placeholder="Status do produto" name="produtoStatus" value="<?php echo $row['produto_status']; ?>">
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
