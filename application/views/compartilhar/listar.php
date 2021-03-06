<script>
	$(document).ready(function() {
		$('.btn-remove').click(function(e) {
			console.log($(this).data('id'));
			$('#modal-remove-share').modal('show');
			$newID = $(this).data('id');
			$('#btn-confirme-remove').attr('data-id', $newID);
		});
		$('#btn-confirme-remove').click(function(e) {
			location.href = "excluir/" + $(this).data('id');
		});
	});
</script>

<div class="container share-list-screen">
	<?php
	if ($msg = get_msg()) {

		echo '<div class="col-xs-12 msg">';
		echo $msg;
		echo '</div>';
	}
	?>
	<div id="modal-remove-share" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<h4>Deseja mesmo remover?</h4>
				<div class="modal-footer">
					<button id="btn-confirme-remove" type="button" class="btn btn-danger">Deletar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<section class="content-header">
		<h1>
			Assuntos compartilhados
			<!-- <small>Preview</small> -->
		</h1>
		<a class="btn btn-success" href="<?php echo base_url() . 'compartilhar/cadastrar' ?>"><i class="fa fa-plus"></i></a>
	</section>
	<div class="row">
		<?php $index = true ?>
		<?php foreach ($compartilhamentos as $compartilhamento) { ?>
		<?php if ($index) { ?>
		<div class="col-xs-12 col-md-4">
			<div class="box box-success">
				<div class="box-header ui-sortable-handle" style="cursor: move;">

					<h3 class="box-title"><?php if (isset($compartilhamento->titulo)) echo $compartilhamento->titulo ?></h3>
					<h5><?php if (isset($compartilhamento->categoria)) echo $compartilhamento->categoria ?></h5>
				</div>
				<div class="share-list-screen__card-footer">
					<div class="share-list-screen__stats">
						<div class="group">
							<i class="fa fa-thumbs-up"></i>
							<p><?php if (isset($compartilhamento->curtidas)) echo $compartilhamento->curtidas ?></p>
						</div>
						<div class="group">
							<i class="fa fa-user"></i>
							<p>0</p>
						</div>
					</div>
					<div class="share-list-screen__actions">
						<a href="<?php base_url() ?>editar/<?php if (isset($compartilhamento->ID)) echo $compartilhamento->ID ?>" data-id="<?php if (isset($compartilhamento->ID)) echo $compartilhamento->ID ?>" type="button" class="btn btn-warning btn-edit">
							<i class="fa fa-pencil"></i>
						</a>
						<button data-id="<?php if (isset($compartilhamento->ID)) echo $compartilhamento->ID ?>" type="button" class="btn btn-danger btn-remove">
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<?php
				if (isset($compartilhamentos) && sizeof($compartilhamentos) > 0) { } ?>

		<?php } else { ?>
		<p>Sem informações cadastradas</p>
		<?php
			}
		} ?>
	</div>
</div>