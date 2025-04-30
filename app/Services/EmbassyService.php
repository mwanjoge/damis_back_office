<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Country;
use App\Models\Embassy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmbassyService
{
    public function create(Request $request): Model|Embassy
    {
        $embassy = Embassy::query()->create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return $embassy;
    }

    public function createAccount(Request $request): Model|Account
    {
        $account = new Account([
            'name' => $request->name,
            'has_depertment' => $request->has_depertment??false,
        ]);

        return $account;
    }

    public function attachCountries(Embassy|Model $embassy, Request $request){
        if($request->country_id){
            Country::query()->whereIn('id', $request->countries)->update([
                'embassy_id' => $embassy->id,
            ]);
        }
    }
}