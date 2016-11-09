<div class="content">
	<div class="row">
		<div class="col-xs-10 center">
			<h2>Crear Categoria</h2>
			<div class="form_create">
				<form>
					<input type="text" placeholder="Nombre">
					<textarea placeholder="Descripcion"></textarea>
					<select>
						<option value="null">Categoria Padre</option>
						<option value="1">Cate1</option>
						<option value="2">Cate2</option>
						<option value="3">Cate3</option>
					</select>
					<input type="submit" value="guardar" />
				</form>
			</div>
		</div>
	</div>
	<div class="row registros_actuales">
		<div class="col-xs-10 center">
			<h2>Listado categorias</h2>
			<div class="box">
				<table class="table table-bordered table-hover dataTable" role="grid">
					<thead>
						<tr role="row">
							<td>Nombre</td>
							<td>Descripcion</td>
							<td>Categoria</td>
						</tr>
					</thead>
					<tbody>
					<?php
						$categorias = new Categoria;
						$listado_categorias = $categorias->obtenerCategorias();
						foreach ($listado_categorias as $categoria){
							?>
							<tr role="row">
								<td><?= $categoria["nombre"]?></td>
								<td><?= $categoria["descripcion"]?></td>
								<td><?= $categorias->obtenerCategoriaNombre($categoria["id_padre"])?></td>
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
