$( document ).ready( function()
{
   $(".number-of-votes").on("votedOn",function( e, voteType )
   {
       var _whatIsVotedOn = null;
       var _votedUpOrDown = null;
        console.log(e);
       if ( voteType.indexOf("post") !== -1){
           _whatIsVotedOn = "Post";
       }
       else if ( voteType.indexOf("comment") !== -1)
           {
               _whatIsVotedOn = "Comment";
           }

       if ( voteType.indexOf("up") !== -1){
           _votedUpOrDown = "up";
       }
       else if ( voteType.indexOf("down") !== -1)
           {
               _votedUpOrDown = "down";
           }
   });
   
   $(".votes-paragraph").on('click', 'a',function(event){
                isLoggedIn();
               event.preventDefault();
               var voteType = $(this).attr('class');
               $(this).parent().find(".number-of-votes").trigger("votedOn", [voteType]);
            
           
    });
           
           
    function isLoggedIn() 
    {     
            $.getJSON("/check-user", function( data )
           {
             if ( data === true )
             {
                 return;
             }
             else
             {
                 
                 if ($(".main-content-area").children().index(".alert-warning") !== -1) 
                 {
                     // it's a child
                     return false;
                 }
                 else
                 {
                   $(".main-content-area").prepend(
                        "<div class='alert alert-warning alert-dismissable'>" +
                        "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>" + "&times;" +"</button>" +
                        "<strong>" + "Please note!" +"</strong>" +" You need to be logged in, in order to vote on posts."
                        +"</div>" );
                 return false;
                  }
             }
             });

    }
        
});
   
   
   
  
