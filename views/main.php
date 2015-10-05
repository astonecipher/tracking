	<div class="container">

		<div id='display'>
			<table id='top_table'>
				<thead>
					<tr>
						<th>Artist</th>
						<th>Song</th>
						<th>Ranking</th>
						<?php if ( isset( $_SESSION['username'] ) ): ?>
							<th>Action</th>
						<?php endif; ?>

					</tr>

					<tbody>
					<?php for( $index = 0; $index < count( $tbody ); $index++ ): ?><tr>
						<td class='ol-md-2'><?=$tbody[ $index ]['artist_display_name']?></td>
						<td class='col-md-4'><?=$tbody[ $index ]['track_name']?></td>
						<td class='col-md-1'><?php echo number_format( $tbody[ $index ]['rank'], 3); ?></td>
						<?php if ( isset( $_SESSION['username'] ) ): ?>
							<td  class='col-md-4'>
							<a class='btn btn-success' href='javascript:void(0)' onclick='increase_pop("<?=$tbody[ $index ]['track_id']?>")'>Increase Popularity</a>
							<a class='btn btn-danger' href='javascript:void(0)' onclick='decrease_pop("<?=$tbody[ $index ]['track_id']?>")'>Decrease Popularity</a>
							</td>
						<?php endif; ?>				
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>

	</div>

<div id='response_modal'></div>
	<!-- Modal -->
	<div class="modal fade" id="add_track" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Add Track</h4>
				</div>
				<div class="modal-body">
					<form>
						<div id='stored_artist' class='form-group'>
							<label class='label label-default'>Artist: </label> <select
								id='artist' class='form-control'>
								<option>Choose Artist</option>
								<?php for( $index = 0; $index < count( $artist ); $index++ ): ?>
								<option value='<?=$artist[ $index ]['artist_id'] ?>'>
									<?=$artist[ $index ]['artist_display_name']?>
								</option>
								<?php endfor; ?>
							</select>
						</div>

						<div class='form-group'>
							<a href='javascript:void(0)' onclick='display_new_artist()'>Add
								New Artist</a>
						</div>
						<div id='modal_part'>
							<hr>
							<div class='form-group'>
								<label class='label label-default'>Username: </label> <input
									type='text' class='form-control' id='username'>
							</div>
							<div class='form-group'>
								<label class='label label-default'>Display Name: </label> <input
									type='text' class='form-control' id='display_name'>
							</div>
							<hr>
						</div>
						<div id='album_section'>
							<div id='album_part' class='form-group'>
								<label class='label label-default'>Album: </label> <select
									class='form-control' id='album'></select>
							</div>
							<div class='form-group'>
								<a href='javascript:void(0)' onclick='display_new_album()'>Add
									New Album</a>
							</div>
							<div id='modal_album'>
								<hr>
								<div class='form-group'>
									<label class='label label-default'>New Album Name: </label> <input
										type='text' class='form-control' id='new_album'>
								</div>
								<hr>
							</div>
						</div>
						<div class='form-group'>
							<label class='label label-default'>Track Name: </label> <input
								type='text' class='form-control' id='track_name'>
						</div>
						<div class='form-group'>
							<label class='label label-default'>Initial Ranking: </label> <input
								type='text' class='form-control' id='intital_rank'>
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id='save_track' class="btn btn-primary">Save
						changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->





	<script
		src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js'></script>
	<script src='./assets/scripts/bootstrap.min.js'></script>
	<script src='./assets/datatables/js/jquery.dataTables.min.js'></script>
	<script src='./assets/scripts/chart.js?ver=aoisjdf'></script>


</body>
</html>