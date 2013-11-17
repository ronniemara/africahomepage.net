$(document).ready( function()
{

	$( '.delete-btn' ).each( function()
		{
			var btn = this;
			$(btn).click(function()
			{
				comment_delete(btn.id);
			});
		});	

});

function comment_delete(comment_id)
{
 
	$.ajax
	(
		{
			url: "/comments/" + comment_id,
			type: 'DELETE',
			success: function(data, textStatus, jqXHR)
						{
							console.log(jqXHR);
							$('#' + comment_id).detach();
						}
		}	
	);
}

