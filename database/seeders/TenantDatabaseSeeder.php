<?php

namespace Database\Seeders;


use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\TreatmentPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Dentist::count() == 0) {
            foreach ($this->dentists() as $dentist) {
                Dentist::create($dentist);
            }
        }

        if (Patient::count() == 0) {
            foreach ($this->patients() as $patient) {
                Patient::create($patient);
            }
        }

        if (Treatment::count() == 0) {
            foreach ($this->treatments() as $treatment) {
                Treatment::create($treatment);
            }
        }

        if (TreatmentPlan::count() == 0) {
            foreach ($this->plans() as $plan) {
                TreatmentPlan::create($plan);
            }
        }
    }


    protected function patients()
    {

        return [
            [
                'name' => 'Emre Can',
                'email' => 'emre.can84@gmail.com',
                'mobile' => '+90 534 856 66 22',
                'occupation' => 'Professor',
                'gender' => 'M',
                'birthdate' => '1984-02-23',
                'blood_group' => 'A+',
                'country' => 'Turkey',
                'city' => 'Istanbul',
                'postal_code' => '3463',
                'address' => 'Fatih St. 1234',
            ],
            [
                'name' => 'Ramazan Gultekin',
                'email' => 'ramzangul@gmail.com',
                'mobile' => '+90 534 625 42 78',
                'occupation' => 'Engineer',
                'gender' => 'M',
                'birthdate' => '1986-01-03',
                'blood_group' => 'B+',
                'country' => 'Turkey',
                'city' => 'Istanbul',
                'postal_code' => '3463',
                'address' => 'Fatih St. 1234',
            ],
            [
                'name' => 'Rumeysa Guden',
                'email' => 'ragunden112@gmail.com',
                'mobile' => '+90 534 525 24 87',
                'occupation' => 'Journalist',
                'gender' => 'M',
                'birthdate' => '1986-01-03',
                'blood_group' => 'B+',
                'country' => 'Turkey',
                'city' => 'Istanbul',
                'postal_code' => '3463',
                'address' => 'Fatih St. 1234',
            ],
        ];
    }

    protected function dentists()
    {
        return [
            [
                'name' => 'Mehmet Sonmez',
                'email' => 'mehmet.sonmez@dentalcrm.intranet',
                'mobile' => '+90 2544 872 55 33',
                'password' => bcrypt('Pass123456'),
                'expertise' => 'Surgery',
                'country' => 'Turkey',
                'city' => 'Ankara',
                'postal_code' => '06490',
                'address' => 'Bahcelievler St. 123',
                'email_verified_at' => gmdate('Y-m-d H:i:s'),
            ]
        ];
    }

    protected function treatments()
    {

        /**
         * DIAGNOSIS AND TREATMENT PLANNING
         */
        return [
            [
                'code' => '1-1',
                'name' => 'Dental Examination',
                'category' => 'DIAGNOSIS AND TREATMENT PLANNING',
                'price' => '660.00',
            ],
            [
                'code' => '1-2',
                'name' => 'Specialist Dentist Examination',
                'category' => 'DIAGNOSIS AND TREATMENT PLANNING',
                'price' => '750.00',
            ],
            [
                'code' => '1-3',
                'name' => 'Control Physician Examination',
                'category' => 'DIAGNOSIS AND TREATMENT PLANNING',
                'price' => '715.00',
            ],
            [
                'code' => '2-1',
                'name' => 'Amalgam Filling (One Sided)',
                'category' => 'TREATMENT AND ENDODONTICS',
                'price' => '1465.00',
            ],
            [
                'code' => '2-2',
                'name' => 'Amalgam Filling (Double-Sided)',
                'category' => 'TREATMENT AND ENDODONTICS',
                'price' => '1870.00',
            ],
            [
                'code' => '2-3',
                'name' => 'Amalgam Filling (Three Sided)',
                'category' => 'TREATMENT AND ENDODONTICS',
                'price' => '2345.00',
            ],
            [
                'code' => '3-1',
                'name' => 'Guided Erasing with Abrasion (Per Session)',
                'category' => 'PEDODONTICS',
                'price' => '735.00',
            ],
            [
                'code' => '3-2',
                'name' => 'Fissure Covering (Sealant - Single Tooth)',
                'category' => 'PEDODONTICS',
                'price' => '715.00',
            ],
            [
                'code' => '3-3',
                'name' => 'Superficial Fluoride Application (Half Chin)',
                'category' => 'PEDODONTICS',
                'price' => '775.00',
            ],
            [
                'code' => '4-1',
                'name' => 'Full Denture (Acrylic - Single Jaw)',
                'category' => 'PROSTHETICS',
                'price' => '14845.00',
            ],
            [
                'code' => '4-2',
                'name' => 'Partial Denture (Acrylic - Single Jaw)',
                'category' => 'PROSTHETICS',
                'price' => '14390.00',
            ],
            [
                'code' => '4-3',
                'name' => 'Full Prosthesis (Reinforced with Cast Metal - Single Jaw)',
                'category' => 'PROSTHETICS',
                'price' => '19190.00',
            ],
            [
                'code' => '5-1',
                'name' => 'Tooth Extraction',
                'category' => 'ORAL-DENTAL AND MAXILLOFACIAL SURGERY',
                'price' => '1270.00',
            ],
            [
                'code' => '5-2',
                'name' => 'Complicated Tooth Extraction',
                'category' => 'ORAL-DENTAL AND MAXILLOFACIAL SURGERY',
                'price' => '2450.00',
            ],
            [
                'code' => '5-3',
                'name' => 'Impacted Tooth Operation',
                'category' => 'ORAL-DENTAL AND MAXILLOFACIAL SURGERY',
                'price' => '4465.00',
            ],
            [
                'code' => '6-1',
                'name' => 'Scaling (Stone Cleaning - Single Jaw)',
                'category' => 'PERIODONTOLOGY',
                'price' => '1700.00',
            ],
            [
                'code' => '6-2',
                'name' => 'Subgingival Curettage (Single Tooth)',
                'category' => 'PERIODONTOLOGY',
                'price' => '965.00',
            ],
            [
                'code' => '6-3',
                'name' => 'Subgingival Medication Application',
                'category' => 'PERIODONTOLOGY',
                'price' => '130.00',
            ],
            [
                'code' => '7-1',
                'name' => 'Lateral Cephalometric Film Analysis',
                'category' => 'ORTHODONTICS',
                'price' => '790.00',
            ],
            [
                'code' => '7-2',
                'name' => 'Antero Posterior Cephalometric Film Analysis (Frontal Film Analysis)',
                'category' => 'ORTHODONTICS',
                'price' => '785.00',
            ],
            [
                'code' => '7-3',
                'name' => 'Bone Age Determination',
                'category' => 'ORTHODONTICS',
                'price' => '365.00',
            ]

        ];
    }

    protected function plans()
    {
        return [
            [
                'name' => 'Treatment Plan 1 for patient #1',
                'dentist_id' => 1,
                'patient_id' => 1,
                'start_date' => '2024-05-25',
                'end_date' => '2024-06-06',
                'notes' => 'Some treatment plan notes goes here',
                'status' => 'closed',
            ],
            [
                'name' => 'Treatment Plan 2 for patient #2',
                'dentist_id' => 1,
                'patient_id' => 3,
                'start_date' => '2025-01-20',
                'end_date' => '2024-01-31',
                'notes' => 'Some treatment plan notes goes here',
                'status' => 'open',
            ],
            [
                'name' => 'Treatment Plan 3 for patient #3',
                'dentist_id' => 1,
                'patient_id' => 3,
                'start_date' => '2024-02-14',
                'end_date' => '2024-02-28',
                'notes' => 'Some treatment plan notes goes here',
                'status' => 'open',
            ],
        ];
    }
}
