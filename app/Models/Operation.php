<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $table = 'plan_treatment';
    public $incrementing = true;

    protected $fillable = [
        'treatment_plan_id',
        'treatment_id',
        'discount',
        'tooth',
        'treatment_date',
        'notes',
    ];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id');
    }

    public function treatmentPlan()
    {
        return $this->belongsTo(TreatmentPlan::class, 'treatment_plan_id');
    }
}
