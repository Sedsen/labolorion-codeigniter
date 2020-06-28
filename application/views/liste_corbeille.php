<div class="row">
	<div class="col col-lg-10 text-center">
		<h2 class="text-success">Liste des produits dans la corbeille</h2>
		<div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Produit</th>
						<th scope="col">Nombre</th>
						<th scope="col">Prix de vente</th>
						<th scope="col">Total</th>
						<th scope="col">Supprimer</th>
					</tr>
				</thead>
				<tbody>
					<?php $cart_contents = $this->session->userdata('cart_contents');
					//var_dump($cart_contents);
					if ($cart_contents!==NULL) {
						foreach ($cart_contents as $row) {
							
						if (!empty($row['name'])) {
					 ?>
					<tr>
						<th scope="row"><?php echo $row['id'] ?></th>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['qty']; ?></td>
						<td><?php echo $row['price']; ?></td>
						<td><?php echo $row['subtotal']; ?></td>
						
						<td><a href="<?php echo base_url("index.php/Lorion/remove_produit/").$row['rowid']; ?>" class="btn btn-danger">Supprimer</a></td>
					</tr>
				<?php }
				} ?>
				<tr>
					<th scope="row">Total</th>
					<td></td>
					<td class="text-info" style="font-weight: bold;"><?php echo $cart_contents['total_items']; ?></td>
					<td></td>
					<td class="text-info" style="font-weight: bold;"><?php echo $cart_contents['cart_total']; ?></td>
				</tr>
				</tbody>
			</table>
			<?php }//var_dump($cart_contents); ?>
		</div>
		<?php echo  anchor('Lorion', 'Continuer les achats'); ?> <br><br>
	</div>
</div>