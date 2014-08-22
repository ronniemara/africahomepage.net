<?php


class VotesController extends BaseController {
    
    protected $vote = null;
    protected $voted_on = null;


    public function __construct(Vote $vote) {
        $this->vote = $vote    ;
    }

    public function upvote() {
        $votable_id = Input::get('itemId');
        $votable_type = Input::get('whatIsWhatVotedOn');
        $voted_already = $this->vote->where('votable_id', '=', $votable_id)->where('votable_type', '=', $votable_type)->first();
        if ($voted_already == null)
        {
            $this->vote->count = 1;
            $this->vote->votable_id = $votable_id;
            $this->vote->votable_type = $votable_type;
            $this->vote->save();
            $this->voted_on = $this->vote->toArray();
        }
        else 
        {
            $voted_already->count = $voted_already->count + 1;
            $voted_already->save();
            $this->voted_on = $voted_already->toArray();
        }
        return json_encode($this->voted_on);  
    }
    
    public function downvote(){
        $votable_id = Input::get('itemId');
        $votable_type = Input::get('whatIsWhatVotedOn');
        $voted_already = $this->vote->where('votable_id', '=', $votable_id)->where('votable_type', '=', $votable_type)->first();
        if ($voted_already == null)
        {
            $this->vote->count = -1;
            $this->vote->votable_id = $votable_id;
            $this->vote->votable_type = $votable_type;
            $this->vote->save();
            $this->voted_on = $this->vote->toArray();
        }
        else 
        {
            $voted_already->count = $voted_already->count - 1;
            $voted_already->save();
            $this->voted_on = $voted_already->toArray();
        }
        return json_encode($this->voted_on);  
    }
    
    public function getvotes()
    {
        $votable_id = Input::get('votable_id');
        $votable_type = Input::get('votable_type');
        $row = $this->vote->where('votable_id', '=', $votable_id)->where('votable_type', '=', $votable_type)->first();
        if($row != null)
        {
        $count = intval($row->count);
        }
        else
        {
            $count = 0;
        }
        return json_encode($count);
    }
            
            
}
