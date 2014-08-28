$( document ).ready( function()
{   
    
    var _anchorId = null;
    var _Slice = null;
    var _votedUpOrDownString = null;
    
    $(".votes-div").each(function(index, value)
    {
        var _slice = null;
        //get the votable_type variable
        var _elem = $(value);
        var _aClass = _elem.find("a").attr("class");
        var _firstLetter = _aClass.substring(0,1);

        if (_firstLetter === 'p')
        {
         _slice = _aClass.substring(0,4);
        }
        else if (_firstLetter === 'c')
        {
         _slice = _aClass.substring(0,7);
        }
        
         _Slice = capitaliseFirstLetter(_slice);

         //used to find the votable_id variable
         _anchorId = _elem.find("a").attr("id");

         //call the getvotes route and pass data. 
	 //callback appends the vote count to the spam element
         $.get( "/getvotes", 
		{"votable_id" : _anchorId ,"votable_type" : _Slice}
	      ).done(  function(data)
                        {
                         //
                         _elem.find("span.number-of-votes").text(parseInt(data,10));
                        });
    });
   
    function capitaliseFirstLetter(string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
   
    $(".number-of-votes").on("votedOn",function( e, voteType, _Id, event )
        {
            var _whatIsVotedOn = null;
            var _itemId        = _Id;

            if ( voteType.indexOf("post") !== -1)
            {
                _whatIsVotedOn = "Post";
            }
            else if ( voteType.indexOf("comment") !== -1)
            {
                _whatIsVotedOn = "Comment";
            }

            if ( voteType.indexOf("up") !== -1)
            {
            _votedUpOrDownString = "/vote-up";
            }
            else if ( voteType.indexOf("down") !== -1)
            {
            _votedUpOrDownString = "/vote-down";
            }            
            
            $.post(  _votedUpOrDownString,
		    { whatIsWhatVotedOn: _whatIsVotedOn, itemId: _itemId}
		  ).done(function(data,status,jqXHR)
                    {
                       if (jQuery.parseJSON(jqXHR.responseText))
			  {
				var data =jQuery.parseJSON(jqXHR.responseText);
				var str1 = "#";
				var str2 = Number(data.votable_id);
				var str3 = ".number-of-votes";
				var _selector = str1.concat(str2,str3);
			    $(_selector).text(parseInt(data.count),10);   
			  }
		       else 
			  {
				 if ($(".main-content-area").children().index(".alert-warning") !== -1) 
			              {
					  // it's a child
			                 return false;
				      }
                                 else					                                      {					                                         $(".main-content-area").prepend	( "<div class='alert alert-warning alert-dismissable'>" +                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>" + "&times;" +"</button>" +                                       "<strong>" + "Please note!" +"</strong>" +" You need to be logged in, in order to vote on posts."                                                +"</div>"
					 );
					     return false;                                                         } 
			  }
                    });
        });

	//on click of a vote icon
     $(".votes-div").on('click', 'a',function(event)
     {
		var _voteClick = $(this);        
		event.preventDefault();
		var voteType = _voteClick.attr('class');
		var _Id = _voteClick.attr('id');
		_voteClick.parent().find(".number-of-votes").trigger("votedOn",[voteType, _Id, event]); 
        });
    
         
    
});
