<?php
/**
 * Pedidos
 *
 * Website Pedidos content
 * @package
 * @name Pedidos
 * @author Adriano K. Nakamura<adriano.k.nakamura@gmail.com>
 * @version 0.1
 */
$returnMessage = "";
if (isset($_POST['deletePedido'])) {

	$pedidoId = trim($_POST['pedidoId']);

	try {

		$sql = "DELETE FROM 
					sis_pedidos 
				WHERE pedido_id = ?";

		$sth = $dbh->prepare($sql);
		$sth->bindParam(1, $pedidoId, PDO::PARAM_INT);
		$sth->execute();
		
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}
?>

<div class="panel panel-default">
	<div class="panel-heading">Pedidos</div>
	
		<div class="container-fluid">
			<div class="accordion" id="accordion2">
				<div class="accordion-group">

					<table class="table">
						<thead>
							<tr>
								<th>Id. Pedido</th>
								<th>Dt. Pedido</th>
								<th>Nm. Cliente</th>
								<th>E-mail</th>
								<th>Telefone</th>
								<th>Produto</th>
								<th>Valor</th>
								<th>Quantidade</th>
								<th>Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						<?php
						try {

							$sql = "SELECT 
										d.*, 
										p.*, 
										c.*, 
										DATE_FORMAT(d.pedido_registered_dt,'%d/%m/%Y') AS pedido_registered_dt 
									FROM 
										sis_pedidos d, sis_produtos p, sis_clientes c
									WHERE 
										d.cliente_id = c.cliente_id AND 
										d.produto_id = p.produto_id ORDER BY d.pedido_registered_dt ASC;";
										

							$sth = $dbh->prepare($sql);
							$sth->execute();

							while($row = $sth->fetch()) {
							?>

							<tr>
								<th>
									<div class="accordion-heading">
											<?php echo $row['pedido_id']; ?>
									</div>
								</th>
								<td>
									<div class="accordion-heading">
											<?php echo $row['pedido_registered_dt']; ?>
									</div>
								</td>
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
											<?php echo $row['produto_nm']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo number_format($row['produto_vl'],2,',','.'); ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo $row['produto_qt']; ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
											<?php echo number_format($row['produto_qt']*$row['produto_vl'],2,',','.'); ?>
									</div>
								</td>
								<td>
									<div class="accordion-heading">
										<form action="pedidos" method="post" >
											<input type="hidden" name="deletePedido" value="deletePedido" >
											<input type="hidden" name="pedidoId" value="<?php echo $row['pedido_id']; ?>" >
											<button type="submit" class="btn btn-xs btn-danger">Excluir</button>
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
