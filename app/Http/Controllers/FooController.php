<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooController extends Controller
{
    public function cget(){
      return response()->json([
        [
          'id' => 1,
          'name' => 'foo1',
        ],
        [
          'id' => 2,
          'name' => 'foo2',
        ]
      ]);
    }

    public function get(Request $request, int $id){
      $data = [
        [
          'id' => 1,
          'name' => 'foo1',
        ],
        [
          'id' => 2,
          'name' => 'foo2'
        ]
      ];
      //return $data[id-1];
      return response()->json($data[$id-1]);
    }

    public function delete(Request $request, int $id){
      return response()->json([]);
    }

    public function post(Request $request){

    }

    public function put(Request $request, int $id){

    }
}
