<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model{
    protected $fillable = ['user_id', 'agent_id', 'sla', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status', 'doc_path'];

    public function category(){
    	return $this->belongsTo(Category::class);
	}
	public function comments(){
    	return $this->hasMany(Comment::class);
	}
	public function user(){
    	return $this->belongsTo(User::class);
	}
}
