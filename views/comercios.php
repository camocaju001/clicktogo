<div class="content">
	<div class="row">
		<div class="col-xs-10 center">
			<h2>Crear Comercio</h2>
			<div class="form_create">
				<form>
					<input type="text" placeholder="Nombre">
					<textarea placeholder="Descripcion"></textarea>
					<input type="text" placeholder="Pedido minimo">
					<select>
						<option>Categoria</option>
						<option value="1">Cate1</option>
						<option value="2">Cate2</option>
						<option value="3">Cate3</option>
					</select>
					<input type="text" placeholder="Costo domicilio">
					<input type="submit" value="guardar" />
				</form>
			</div>
		</div>
	</div>
	<div class="row registros_actuales">
		<div class="col-xs-10 center">
			<h2>Listado comercios</h2>
			<div class="box">
				<table class="table table-bordered table-hover dataTable" role="grid">
					<thead>
						<tr role="row">
							<td>Nombre</td>
							<td>Descripcion</td>
							<td>Categoria</td>
							<td>Costo domicilio</td>
							<td>Pedido minimo</td>
						</tr>
					</thead>
					<tbody>
					<?php
						$comercios = new Comercios;
						$listado_comercios = $comercios->listarComercios();
						foreach ($listado_comercios as $comercio){
							?>
							<tr role="row">
								<td><?= $comercio->nombre?></td>
								<td><?= $comercio->descripcion?></td>
								<td><?= $comercio->categoriatId?></td>
								<td><?= $comercio->costo_domicilio?></td>
								<td><?= $comercio->pedido_minimo?></td>
							</tr>
							<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
