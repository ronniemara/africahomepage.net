$( document ).ready( function()	{

//this will fire once the page has been fully loaded
$( '#comment-post-btn' ).click( function() {
comment_post_btn_click();

});

});

function comment_post_btn_click()
{
	
	//text entered in text-area
	var _comment = $( '#comment-post-text' ).val();
	var _userId = $( '#userId' ).val();
	var _postId = $( '#postId' ).val();

	if( _comment.length > 0 && _userId != null )
	{
	//proceed with ajax call
	$( '.comment-insert-container' ).css('border', '1px solid #e1e1e1');
	
	$.post("/comments" ,
		{
			task: "comment-insert",
			user_id: _userId,
			message: _comment,
			post_id: _postId

		}
   				
	      ).fail(
		      function( )
		      		{
					console.log( "Error" ); 
				}
		      ).done(
		      function( data, textStatus, jqXHR )
		      		{
					var jsonData = jqXHR.responseText;
		// var jsonParse = jQuery.parseJSON(data.responseText);	
					comment_insert( jQuery.parseJSON(jsonData) ); 
					//console.log( "ResponseText: " + jsonData   );
					console.log(jqXHR); 
				}
		      );

	console.log( _comment + " userid:" + _userId );
	} 
	else
	{
	//highlight text-area in red
	$( '.comment-insert-container' ).css('border', '1px solid #ff0000');
		console.log('text area is empty');
	}
	
	//remove text once comment has been posted
	$('#comment-post-text').val("");
}

function comment_insert( data )
{
			var t = "";
			t += '<li class="comment-holder id="' + data.id + '">';
			t += '<div class="user-pic"></div>';
			t += '<div class="comment-box">';
			t += '<h3 class="username-field">' + data.createdBy + '</h3>';
			t += '<div class="comment-text">' + data.message + '</div>';
			t += '</div>';
			t += '<div class="comment-buttons-holder">';
			t += '<ul>';
			t += '<li class="delete-btn">X</li>';
			t += '</ul>';
			t += '</div>';
			t += '</li>';

		$('.comment-holder-ul').prepend( t );
}

