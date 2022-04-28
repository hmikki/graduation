<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property mixed id
 * @property mixed employee_id
 * @property mixed type
 * @property mixed ref_id
 * @property mixed ip
 */
class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = ['employee_id','type','ref_id','ip'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
    public static $Type =[
        'Login'=>1,
        'Logout'=>2,
    ];

    public static function CreateLog($type,$ref_id = null,$ip = null,$employee_id=null){
        $Log = new Log();
        $Log->type = $type;
        $Log->ref_id = $ref_id;
        $Log->employee_id = ($employee_id)?$employee_id:auth()->user()->id;
        $Log->ip = $ip;
        $Log->save();
    }
}
