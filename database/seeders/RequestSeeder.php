<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\Account;
use App\Models\Embassy;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Member;
use App\Models\Country;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
class RequestSeeder extends Seeder
{
    public function run()
    {
        $members = Member::all();

        foreach ($members as $member) {
            $embassy = Embassy::where('id', $member->account->embassy_id)->first();
            if($embassy->country_id) {
                $request = Request::factory()->create([
                    'account_id' => $member->account_id,
                    'embassy_id' => $member->account->embassy_id,
                    'member_id' => $member->id,
                    'country_id' => $embassy->country_id,
                ]);
                
                $invoice = $request->invoice()->create([
                    'account_id' => $request->account_id,
                    'request_id' => $request->id,
                    'member_id' => $request->member_id,
                ]);

                $take = random_int(1,  3);
                //$services->random();
                foreach (Service::query()->inRandomOrder()->take($take)->get() as $service) {
                    $bill = $service->billableItems()->where('embassy_id', $request->embassy_id)->first();
                    $request->requestItems()->create([
                        'account_id' => $request->account_id,
                        'service_id' => $service->id,
                        'certificate_holder_name' => $member->name,
                        'certificate_index_number' => Str::random(8),
                        'price' => $bill->price,
                        'currency' => $bill->currency,
                        'currency_code' => $bill->currency_code,
                    ]);

                    $invoice->generalLineItems()->create([
                        'account_id' => $request->account_id,
                        'service_id' => $service->id,
                        'service_provider_id' => $service->service_provider_id,
                        'request_item_id' => $request->requestItems()->where('service_id', $service->id)->where('request_id', $request->id)->first()->id,
                        'price' => $bill->price,
                        'currency' => $bill->currency,
                    ]);
                }

                $request->update([
                    'total_cost' => $request->requestItems->sum('price'),
                    'tracking_number' => strtoupper(Str::random(10)),
                ]);

                $request->invoice()->update([
                    'amount' => $request->requestItems->sum('price'),
                    'payable_amount' => $request->requestItems->sum('price'),
                    'balance' => $request->requestItems->sum('price')
                ]);
            }
            
        }

        Artisan::call('app:cache-dashboard-statistics');
    }
}
