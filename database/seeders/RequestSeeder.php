<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\Embassy;
use App\Models\Service;
use App\Models\Member;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class RequestSeeder extends Seeder
{
    public function run()
    {
        $members = Member::all();
        $accounts = Account::pluck('id')->toArray();
        $embassies = Embassy::whereNotNull('country_id')->get();
        $months = [1, 2, 3, 4, 5];

        foreach ($months as $month) {
            foreach ($members as $member) {
                $embassy = Embassy::inRandomOrder()->first();
                $day = random_int(1,  31);
                $date = Carbon::createFromDate(2025, $month, $day);
                if($embassy->country_id) {
                    $request = Request::factory()->create([
                        'account_id' => $embassy->id,
                        'embassy_id' => $embassy->id,
                        'member_id' => $member->id,
                        'country_id' => $embassy->country_id,
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                    
                    $invoice = $request->invoice()->create([
                        'account_id' => $request->account_id,
                        'request_id' => $request->id,
                        'member_id' => $request->member_id,
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);

                $take = random_int(1, 3);
                foreach (Service::query()->inRandomOrder()->take($take)->get() as $service) {
                    $bill = $service->billableItems()->where('embassy_id', $request->embassy_id)->first();
                    if (!$bill) {
                        continue;
                    }
                    $requestItem = $request->requestItems()->create([
                        'account_id' => $accountId,
                        'service_id' => $service->id,
                        'certificate_holder_name' => $member->name,
                        'certificate_index_number' => Str::random(8),
                        'price' => $bill->price,
                        'currency' => $bill->currency,
                        'currency_code' => $bill->currency_code,
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);

                    $invoice->generalLineItems()->create([
                        'account_id' => $accountId,
                        'service_id' => $service->id,
                        'service_provider_id' => $service->service_provider_id,
                        'request_item_id' => $requestItem->id,
                        'price' => $bill->price,
                        'currency' => $bill->currency,
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                }

                $total = $request->requestItems->sum('price');
                $request->update([
                    'total_cost' => $total,
                    'tracking_number' => strtoupper(Str::random(10)),
                    'updated_at' => $date
                ]);

                $request->invoice()->update([
                    'amount' => $total,
                    'payable_amount' => $total,
                    'balance' => $total,
                    'updated_at' => $date
                ]);
            }
        }

        Artisan::call('app:cache-dashboard-statistics');
    }
}
