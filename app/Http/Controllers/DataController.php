<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\post;
use App\fotoPostingan;
use App\testUser;
use App\post_asli;
use App\foto_post_asli;
use App\panti;

class DataController extends Controller
{
    public function getApa(){

    	return response()->json([
    		"error" => "namaku"
    	], 500);
    }

    public function getHome()
    {
    	$data = post::get();
    	// dd($data);
    	foreach ($data as $key => $value) {
    		$data[$key]["foto"] = fotoPostingan::where('id_post', $value->id_post)->get();
    	}
    	return response()->json($data, 200);
	}
	
	public function getPanti()
	{
		$data = panti::get();
		foreach($data as $key => $value)
		{
			$data = panti::get();
		}

		return response()->json($data, 200);
	}

	public function getUser()
	{
		$data = testUser::get();

		foreach ($data as $key => $value)
		{
			$data = testUser::get();
		}

		return response()->json($data, 200);
	}

	public function getPostData()
	{
		$data = post_asli::get();
		foreach($data as $key => $value)
		{
			$data[$key]["foto"] = foto_post_asli::where('id_post', $value->id_post)->get();
		}
		return response()->json($data, 200);
	}

	public function post(Request $request)
	{
		// dd($request);
		$path = "img\\";
        
		$image1 = ($request->file('img1') == NULL) ? NULL : $request->file('img1');
		$image2 = ($request->file('img2') == NULL) ? NULL : $request->file('img2');
		$image3 = ($request->file('img3') == NULL) ? NULL : $request->file('img3');
		// dd($image1);

		// dd($image1 . $image2 . $image3);

        $request->judul_post = str_replace('"','',$request->judul_post);
        $request->deskripsi_post = str_replace('"','',$request->deskripsi_post);

		$post = new post_asli();
		$post->judul_post = $request->judul_post;
		$post->deskripsi_post = $request->deskripsi_post;
		$post->save();
		if($image1)
		{
			$png = $request->judul_post.'1'.$image1->getClientOriginalExtension();
			$image1->move(public_path($path),$png);

			$foto = new foto_post_asli();
			$foto->id_post = $post->id_post;
			$foto->url_photo = '\\img\\'.$png;
			$foto->save();
		}
		
		if($image2)
		{
			$png = $request->judul_post.'2'.$image2->getClientOriginalExtension();
			$image2->move(public_path($path),$png);

			$foto = new foto_post_asli();
			$foto->id_post = $post->id_post;
			$foto->url_photo = '\\img\\'.$png;
			$foto->save();
		}

		if($image3)
		{
			$png = $request->judul_post.'3'.$image3->getClientOriginalExtension();
			$image3->move(public_path($path),$png);

			$foto = new foto_post_asli();
			$foto->id_post = $post->id_post;
			$foto->url_photo = '\\img\\'.$png;
			$foto->save();
		}
		$data['code'] = 200;
		$data['msg'] = "Sukses";

		return response()->json($data, 200);
	}

}
