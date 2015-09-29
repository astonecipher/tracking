<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
<script
	src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>

<link rel="stylesheet" type="text/css"
	href="./assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css"
	href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">


<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<nav class='navbar navbar-default'>
		<div class='container-fluid'>
			<span class='navbar-brand'>Song List</span>
			<div class="dropdown pull-right">
				<button class="btn btn-default dropdown-toggle" type="button"
					id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="true">
					Dropdown <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a data-toggle="modal" data-target="#add_artist">Add
							Artist</a></li>
					<li><a data-toggle="modal" data-target="#add_track">Add
							Album</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">

		<div id='display'>
			<table id='top_table'>
				<thead>
					<tr>
						<th></th>
						<th>Artist</th>
						<th>Album</th>
						<th>Song</th>
						<th>Ranking</th>
					</tr>
				<tbody>
					<?php for( $index = 0; $index < count( $tbody ); $index++ ): ?>
					<tr>
						<td><?=($index + 1)?></td>
						<?php foreach ( $tbody[ $index ] as $k => $v ): ?>
						<td><?=$v?></td>
						<?php endforeach; ?>
					</tr>
					<?php endfor; ?>


				</tbody>
			</table>
		</div>

	</div>



	<!-- Modal -->
	<div class="modal fade" id="add_artist" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Add Artist</h4>
				</div>
				<div class="modal-body">
					<form>
						<div class='form-group'>
							<label class='label label-default'>Username: </label> <input
								type='text' class='form-control' id='username'>
						</div>
						<div class='form-group'>
							<label class='label label-default'>Display Name: </label> <input
								type='text' class='form-control' id='display_name'>
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->



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
						<div class='form-group'>
							<label class='label label-default'>Artist: </label> <select
								id='artist' class='form-control'>
								<?php for( $index = 0; $index < count( $artist ); $index++ ): ?>
								<option value='<?=$artist[ $index ]['artist_id'] ?>'>
									<?=$artist[ $index ]['artist_display_name']?>
								</option>
								<?php endfor; ?>
							</select>
						</div>

						<div class='form-group'>
							<a href='javascript:void(0)' onclick='display("modal_part")'>Add New
								Artist</a>
						</div>
						<div id='modal_part' >
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
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->





	<script
		src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js'></script>
	<script
		src='./assets/scripts/bootstrap.min.js'></script>
	<script
		src='./assets/datatables/js/jquery.dataTables.min.js'></script>




	<script>
		$(document).ready(function() {
			$('#modal_part').toggle();
			$('#top_table').dataTable( {
				"aaSorting": [[ 3, "desc" ]]
			} );
			
			
		});
		
		function display( portion ){
			$('#' + portion).toggle();
		}
		
	</script>


</body>
</html>