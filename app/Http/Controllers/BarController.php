<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bar;
use JWTAuth;
use Auth;
use App\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use App\Http\Requests\StoreBar;

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $user = JWTAuth::parseToken()->authenticate();
      // dd($user);

      // dd(Auth::user());
      $this->grantIfRole('ROLE_ADMIN');
      echo "Current PHP version :" . phpversion();
      // $bars = User::get();
      $bars = User::paginate();


      return response()->json($bars->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBar $request)
    {
      // try{
      //   $this->validate($request, [
      //     'bar' => 'required',
      //   ]);
      // } catch(\Exception $e){
      //   throw new \Exception('salah euyy');
      // }

        $bar = new Bar();
        $bar->bar = $request->input('bar');
        $bar->save();

        return response()->json($bar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bar = Bar::find($id);
        if ($bar == null) {
          echo "No data with the specified description";
        }
        else {
          return response()->json($bar->toArray());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bar = Bar::find($id);

        // replace the value of bar
        $bar->bar = $request->input('bar');

        // update
        $bar->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bar = Bar::find($id);
        $bar->delete();

        $bars = Bar::get();
        return response()->json($bars->toArray());
    }
}
