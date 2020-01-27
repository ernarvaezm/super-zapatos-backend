<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Validator;
use Response;

class ArticleController extends Controller
{

  /**
   * Display a listing of articles.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return response() ->json(['success' => true, 'articles'=>Article::all()], 200);
  }

    /**
     * Display a listing of the resource filtered by id_store
     *
     * @return \Illuminate\Http\Response
     */
    public function indexById($id)
    {
        $articles = Article::where('store_id',$id )->get();

        return response() ->json(['success' => true, 'articles'=>$articles], 200);
    }

    /**
     * Store a newly article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // validate incoming request
          $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'total_in_shelf' => 'required|numeric',
            'total_in_vault' => 'required|numeric',
            'store_id' => 'required|numeric'
          ]);

       if ($validator->fails()) {
         return response() ->json(['success' => false, 'error_code'=>400, 'error_msg'=>$validator->messages()], 400);
       }

       $article = new Article();
       $article->name =$request->name;
       $article->description =$request->description;
       $article->price =$request->price;
       $article->total_in_shelf =$request->total_in_shelf;
       $article->total_in_vault =$request->total_in_vault;
       $article->store_id =$request->store_id;
       $article->save();
       return response() ->json(['success' => true, 'article'=>$article], 200);
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $article = Article::find($id);
      if ( !$article){
        return response() ->json(['success' => false, 'error_code'=>404, 'error_msg'=>"Record not Found"], 404);
      }
      return response() ->json(['success' => true, 'article'=>$article], 200);
    }

    /**
     * Update the specified article in storage.
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
        'description' => 'required',
        'price' => 'required|numeric',
        'total_in_shelf' => 'required|numeric',
        'total_in_vault' => 'required|numeric',
        'store_id' => 'required|numeric'
      ]);

   if ($validator->fails()) {
     return response() ->json(['success' => false, 'error_code'=>400, 'error_msg'=>$validator->messages()], 400);
   }

      $article = Article::find($id);
      if ( !$article){
        return response() ->json(['success' => false, 'error_code'=>404, 'error_msg'=>"Record not Found"], 404);
      }
      $article->name =$request->name;
      $article->description =$request->description;
      $article->price =$request->price;
      $article->total_in_shelf =$request->total_in_shelf;
      $article->total_in_vault =$request->total_in_vault;
      $article->store_id =$request->store_id;
      $article->save();
      return response() ->json(['success' => true, 'article'=>$article], 200);

    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $article = Article::find($id);
      if ( !$article){
        return response() ->json(['success' => false, 'error_code'=>404, 'error_msg'=>"Record not Found"], 404);
      }

      if ($article->delete()) {
        return response() ->json(['success' => true], 200);
      }
    }
}
