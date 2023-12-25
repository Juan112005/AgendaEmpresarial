<?php

namespace App\Http\Controllers;

use App\Models\Agends;
use App\Models\User;
use App\Models\UsersHasAgends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{
    public function user(){
        $allusers = User::select('id','name','email')->where('id','!=',Auth::id())->get();

        return datatables()->collection($allusers)->toJson();
    }
    public function editagends($id){
        $agend= Agends::find($id);

        return datatables()->collection($agend)->toJson();
    }
}
