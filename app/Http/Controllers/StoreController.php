<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Validator;
use Response;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response() ->json(['success' => true, 'stores'=>Store::all()], 200);
    }

    /**
     * save a new store.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validate incoming request
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'address' => 'required'
        ]);

      if ($validator->fails()) {
        return response() ->json(['success' => false, 'error_code'=>400, 'error_msg'=>$validator->messages()], 400);
      }

      $store = new Store();
      $store->name =$request->name;
      $store->address =$request->address;
      $store->save();
      return response() ->json(['success' => true, 'store'=>$store], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $store = Store::find($id);
          if ( !$store){
            return response() ->json(['success' => false, 'error_code'=>404, 'error_msg'=>"Record not Found"], 404);
          }
          return response() ->json(['success' => true, 'store'=>$store], 200);

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
          // validate incoming request
        $validator = Validator::make($request->all(), [
           'name' => 'required',
           'address' => 'required'
         ]);

       if ($validator->fails()) {
         return response() ->json(['success' => false, 'error_code'=>400, 'error_msg'=>$validator->messages()], 400);
       }

      $store = Store::find($id);
      if ( !$store){
        return response() ->json(['success' => false, 'error_code'=>404, 'error_msg'=>"Record not Found"], 404);
      }
      $store->name =$request->name;
      $store->address =$request->address;
      $store->save();
      return response() ->json(['success' => true, 'store'=>$store], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $store = Store::find($id);
      if ( !$store){
        return response() ->json(['success' => false, 'error_code'=>404, 'error_msg'=>"Record not Found"], 404);
      }

      if ($store->delete()) {
        return response() ->json(['success' => true], 200);
      }

    }
}
