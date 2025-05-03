<?php

namespace Database\Seeders;

use App\Events\EmbassyCreated;
use Illuminate\Database\Seeder;
use App\Models\ServiceProvider;
use App\Models\Service;

class ServiceProviderSeeder extends Seeder
{
    public function run()
    {
        // $accountIds = Account::pluck('id');
        // foreach ($accountIds as $accountId) {
        //     ServiceProvider::factory()->count(2)->create(['account_id' => $accountId]);
        // }

        $providers = [
            'NECTA' => [
                'Primary School Leaving Examination (PSLE)',
                'Certificate of Secondary Education Examination (CSEE)',
                'Advance Certificate of Secondary Education Examination (ACSEE)',
                'Grade A Teachers Certificate Examination (GATCE)',
                'Diploma in Secondary Education Examinations (DSEE)',
                'Grade A Teacher’s Special Course Certificate Examination (GATSCCE)',
            ],
            'NACTVET' => [
                'NTA LEVEL 1 - Certificate of Competence Level I',
                'NTA LEVEL 2 - Certificate of Competence Level II',
                'NTA LEVEL 3 - Certificate of Competence Level III',
                'NTA LEVEL 4 - Basic Technician Certificate',
                'NTA LEVEL 5 - Technician Certificate',
                'NTA LEVEL 6 - Ordinary Diploma',
            ],
            'TCU' => [
                'NTA LEVEL 7 - Advanced Diploma',
                'NTA LEVEL 8 - Bachelor Degree',
                'NTA LEVEL 9 - Master’s Degree',
                'NTA LEVEL 10 - Doctorate',
            ],
            'RITA' => [
                'Birth certificate',
                'Marriage certificate',
                'Divorce certificate',
                'Adoption certificate',
                'Death certificate'
            ],
        ];

        foreach ($providers as $providerName => $services) {
            $provider = ServiceProvider::create(['name' => $providerName]);

            foreach ($services as $serviceName) {
                Service::create([
                    'service_provider_id' => $provider->id,
                    'name' => $serviceName,
                ]);
            }
            // Fire the event for each service provider created
            event(new EmbassyCreated($provider));
        }
    }
}
