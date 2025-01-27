<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\TreatmentPlan;
use Illuminate\Http\Request;

class DentistController extends DashboardController
{
    /**
     * Get a  given dentist treatment plans
     */
    public function getTreatmentPlans(Request $request)
    {
        $treatmentPlans = collect([]);
        if (principal()->isDentist()) {
            $treatmentPlans = principal()->treatmentPlans;
        }
        return view('account.dentist.plans.index', [
            'plans' => $treatmentPlans,
        ]);
    }
}
