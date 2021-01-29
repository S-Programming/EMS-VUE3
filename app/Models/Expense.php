<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

     protected $fillable = ['user_id', 'reason', 'description', 'amount'];
     
    public function user() {
        return $this->belongsTo(User::class);
    }

     /**
     * Expense  Relation it will retuen the all expense assigned status
     *
     * @return bool
     */
    public function requestStatus(){
        return $this->belongsTo(RequestStatus::class,'request_status_id','id');
    }
}
