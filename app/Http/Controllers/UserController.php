<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $results = app('db')->select("SELECT * FROM users");
        return response()->json($results);
    }

    public function get(Request $request, $id)
    {
        $results = app('db')->select("SELECT * FROM users WHERE id = " . $id);
        return response()->json($results);
    }

    public function add(Request $request)
    {
        if($request->isMethod('post'))
        {
            $fname = $request->input('first_name');
            $lname = $request->input('last_name');
            $email = $request->input('email');
            app('db')->select("INSERT INTO users(first_name, last_name, email) VALUES ('$fname', '$lname', '$email') ");
            $id = DB::getPdo()->lastInsertId();
            $results = app('db')->select("SELECT * FROM users WHERE id = " . $id);
            return response()->json($results);
        }
    }

}
