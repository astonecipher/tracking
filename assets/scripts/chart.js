$(document).ready(function() {
	$('#modal_part').toggle();
	$('#modal_album').toggle();
	$('#album_section').toggle();

	$('#save_track').on('click', function() {
		addArtist();
	});

	$('#top_table').DataTable({
		"order" : [ [ 2, "desc" ] ]
	});

	$('#artist').on('change', function() {
		getAlbums($('#artist').val());
	});

});

function display_new_artist() {
	$('#modal_part').toggle();
	$('#album').empty();
	$('#stored_artist').toggle();
	$('#album_section').toggle();
	display_new_album();

}

function display_new_album() {
	$('#modal_album').toggle();
	$('#album_part').toggle();
}
function getAlbums(artist_id) {

	var mString = {};
	mString.action = 'get_albums';
	mString.artist_id = artist_id;
	$.getJSON('', mString, function(data) {
		$('#album').append($('<option>', {
			value : data.id,
			text : data.title
		}));
		$('#album_section').toggle();
	});

}

function login_screen() {
	var mString = {};
	mString.action = 'login_screen';
	$.get('', mString, function(data) {
		$('#response_modal').html(data);
		$('#login').modal('show');
	});
	
}

function addArtist() {

	var mString = {};
	mString.action = 'add_artist';

	if ($('#display_name').val().trim().length >= 2
			&& $('#username').val().trim().length >= 2) {
		mString.name = $('#username').val();
		mString.display_name = $('#display_name').val();
	} else {
		mString.artist = $('#artist').val().trim();
	}
	$.get('', mString, function(data) {
		alert(data);
	});

	$('#display_name').val('');
	$('#username').val('');

}

function alert_track( id ){
	
	alert( "The modification of track: '" + id + "' is not possible, yet. This feature is still in the works.");
	
}