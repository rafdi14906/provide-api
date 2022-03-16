<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $blogs = Blog::all();

            $response = $this->apiHelper->makeResponse('success', 'Retrieve data success!', count($blogs), $blogs);
            return response()->json($response);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
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
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = $this->apiHelper->makeResponse('failed', $validator->errors()->messages());
            return response()->json($response);
        }

        try {
            $blog = Blog::create($request->all());

            $response = $this->apiHelper->makeResponse('success', 'Data created!', 1, $blog);
            return response()->json($response, 201);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $blog = Blog::find($id);

            $response = $this->apiHelper->makeResponse('success', 'Data created!', 1, $blog);
            return response()->json($response, 201);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
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

        $rules = [
            'title' => 'required',
            'content' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = $this->apiHelper->makeResponse('failed', $validator->errors()->messages());
            return response()->json($response);
        }

        try {
            $blog = Blog::where('id', $id)->first();
            $blog->update($request->all());

            $response = $this->apiHelper->makeResponse('success', 'Data updated!', 1, $blog);
            return response()->json($response, 201);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Blog::find($id)->delete();

            $response = $this->apiHelper->makeResponse('success', 'Data deleted!');
            return response()->json($response, 201);
        } catch (\Throwable $th) {
            Log::error($th->getTraceAsString());

            $response = $this->apiHelper->makeResponse('failed', $th->getMessage());
            return response()->json($response);
        }
    }
}
