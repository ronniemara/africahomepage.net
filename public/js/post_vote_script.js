$( document ).ready( function()
{   
    
    var _anchorId = null;
    var _Slice = null;
    
    
    $(".votes-paragraph").each(function(index, value){
         
          var _elem = $(value);
          var _aClass = _elem.find("a").attr("class");
          var _slice = _aClass.substring(0,4);
          _Slice = capitaliseFirstLetter(_slice);
          
          _anchorId = _elem.find("a").attr("id");
          
            $.get("getvotes", {"votable_id" : _anchorId ,"votable_type" : _Slice}).done(function(data){
                //
                _elem.find("span").append(data);
                });
              
    });
   
	function capitaliseFirstLetter(string)
	{
	    return string.charAt(0).toUpperCase() + string.slice(1);
	}
    
	$(".number-of-votes").on("votedOn",function( e, voteType, _Id, event )
        {
	   var _whatIsVotedOn = null;
	   var _votedUpOrDown = null;
	   var _itemId        = _Id;
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
	       
        $.post("/vote-up",
	      { whatIsWhatVotedOn: _whatIsVotedOn, votedUpOrDown: _votedUpOrDown, itemId: _itemId}
	     ).done(function(data,status,jqXHR)
		     {
			var data =jQuery.parseJSON(jqXHR.responseText);
			var str1 = "#";
			var str2 = data.votable_id;
			var str3 = ".number-of-votes";
			var _selector = str1.concat(str2,str3);
			   $(_selector).text(data.count);   
		      });
		   });

     $(".votes-paragraph").on('click', 'a',function(event)
     {
         var _loggedIn = new Boolean();
       	 $.getJSON("/check-user", function( data )
       	               {

         _loggedIn = data;

         });
         if (_loggedIn === false){
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
         else {
         event.preventDefault();
                    var voteType = $(this).attr('class');
                    var _Id = $(this).attr('id');
                    $(this).parent().find(".number-of-votes").trigger("votedOn", [voteType, _Id, event]);     
     }
 });
});
   
   
   
  
