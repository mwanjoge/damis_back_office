<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(){
        $audits = Audit::query()
            ->select('audits.*','users.name as user_name')
            ->join('users','users.id','=', 'audits.user_id')->get();
        return view('audits.index', compact('audits'));
    }
}
