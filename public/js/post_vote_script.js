$(document).ready( function()
{
   $(".post-vote-up").click( function(event)
   {
       $.getJSON("/check-user", function( data )
        {
          
           if ( data === true )
           {   
               var _votableId = event.target.id;
               var _votableType = "Post";
               $.post("/vote-up",
                {
                  votable_id: _votableId,
                  votable_type: _votableType
                }).done(function( data )
                {
                    console.log( data);
                }).fail();
           }
           else
            {
                if ($(".main-content-area").children().index(".alert-warning") !== -1) 
                {
                    // it's a child
                    return;
                }
                else
                {
                  $(".main-content-area").prepend(
                       "<div class='alert alert-warning alert-dismissable'>" +
                       "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>" + "&times;" +"</button>" +
                       "<strong>" + "Please note!" +"</strong>" +" You need to be logged in, in order to vote on posts."
                       +"</div>" );
                 }
            }
               
        });
   });
   
   $(".comment-vote-up").click(function()
   {
       $.get("/users/check", function( data)
        {
          if (data === true)
           {
               var _votableId = $( '#commentVotableId' ).val();
               var _votableType = $( '#commentVotableType' ).val();
               $.post("/votes-up",
                {
                  votable_id: _votableId,
                  votable_type: _votableType
                }).done().fail();
           }
           else
               {
                   console.log('not signed in'); 
               }
        });
   }); 
   
   $(".post-vote-down").click(function()
   {
       $.get("/users/check", function( data)
        {
          if (data === true)
           {
               var _votableId = $( '#postVotableId' ).val();
               var _votableType = $( '#postVotableType' ).val();
               $.post("/votes-down",
                {
                  votable_id: _votableId,
                  votable_type: _votableType
                }).done().fail();
           }
           else
               {
                   console.log('not signed in');
               }
        });
   });
   
   $(".comment-vote-down").click(function()
   {
       $.get("/users/check", function( data)
        {
          if (data === true)
           {
               var _votableId = $( '#commentVotableId' ).val();
               var _votableType = $( '#commentVotableType' ).val();
               $.post("/votes-down",
                {
                  votable_id: _votableId,
                  votable_type: _votableType
                }).done().fail();
           }
           else
               {
                   console.log('not signed in');
               }
        });
   }); 
});
