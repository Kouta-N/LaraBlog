<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showList()
    {
        $blogs = Blog::all();
        return view('blog.list',['blogs' => $blogs]);
    }

    public function showDetail($id)
    {
        $blog = Blog::find($id);
        if(is_null($blog)){
            // $request->session()->flash('err_msg', 'データがありません。');
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.detail',['blog' => $blog]);
    }

    public function showCreate()
    {
        return view('blog.form');
    }

    public function exeStore(BlogRequest $request)
    {
        // dd($request->all());
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            Blog::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        Blog::create($inputs);
        \Session::flash('err_msg', 'ブログを登録しました。');
        return redirect(route('blogs'));
    }

      public function showEdit($id)
    {
        $blog = Blog::find($id);
        if(is_null($blog)){
            // $request->session()->flash('err_msg', 'データがありません。');
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.edit',['blog' => $blog]);
    }

     public function exeUpdate(BlogRequest $request)
    {
        // dd($request->all());
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }

        Blog::create($inputs);
        \Session::flash('err_msg', 'ブログを更新しました。');
        return redirect(route('blogs'));
    }

     public function exeDelete($id)
    {
        if(empty($id)){
            // $request->session()->flash('err_msg', 'データがありません。');
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        try{
            $blog = Blog::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        \Session::flash('err_msg', '削除が成功しました。');
        return redirect(route('blogs'));
    }
}