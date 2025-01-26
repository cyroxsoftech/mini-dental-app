<?php

namespace App\Http\Controllers;

use App\Models\Central\Clinic;
use Illuminate\Http\Request;

class CentralController extends Controller
{

    public function welcome(){
        return view('welcome');
    }

    public function verifyClinic(Request $request)
    {
        if (preg_match(Clinic::REFERENCE_REG_PATTERN, $request->input('clinicId', 0))) {
            $reference = $request->input('clinicId');
            $clinic = Clinic::findByReference($reference);
            if (!$clinic) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'clinicId' => 'The provided clinic reference is invalid.'
                    ]);
            }
            $validated = ['clinicId' => $clinic->id];
        } else {
            $validated = $request->validate([
                'clinicId' => ['required', 'numeric', 'exists:tenants,id'],
            ]);
            $validated['clinicId'] = (int) $validated['clinicId'];
        }

        return redirect()->route('clinic.login', $validated['clinicId']);
    }
}
