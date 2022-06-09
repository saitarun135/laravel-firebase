<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Database\Query;
use Kreait\Laravel\Firebase\Facades\Firebase;

class TestController extends Controller
{
    private $database;
    public function __construct()
    {
        $this->database = FirebaseService::connect();
    }

    public function get(Request $request){
        $data = $this->database->getReference('/users/')
                               ->orderByChild('name')
                               ->equalTo($request->name)
                               ->getValue();
        return response()->json($data);
    }

    public function Register(Request $request){
        $data = $request->all();
        $chk = $this->database->getReference('/users/')->push($data);
        return 'success';
    }

    public function update(Request $request){
        $data = $request->all();
        $this->database->getReference('/users/')->update([json_encode($data)]);
        return 'success';
    }
}
