<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    
    protected $table = 'ticket';
    
    protected $fillable = [
        'ticket_type',
        'user_name',
        'subject',
        'email',
        'descreption',
        'status',
        'created_date',
       
       ];
       
   
    public function users()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
    
    public function ticketType()
    {
        return $this->belongsTo(TycketTypes::class, 'ticket_type');
    }
    

}