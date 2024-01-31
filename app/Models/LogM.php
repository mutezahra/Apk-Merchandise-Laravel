<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class LogM extends Model
{
    use HasFactory;
    protected $table = 'log';
    protected $fillable = ["id", "id_user", "activity", "created_at", "update_at"];


    public function activity($activity){
        $data = [
            'id_user' => Auth::user()->id,
            'activity' => $activity
        ];
    
        LogM::create($data);
    
        return redirect('log');
    }

   

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['id_user', 'activity']);
        
    }

   
    
}
