<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaban\Comments;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentDestroyRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        $comment = Comments::create([
            'task_id' => $request->task_id,
            'user_id' => $request->author_id, // TODO переделать на id авторизированного пользователя
            'content' => $request->content,

        ]);
        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentDestroyRequest $request)
    {
        Comments::where('id', '=', $request->comment_id)
            ->delete();
        return response(["message" => 'Успех'], 200);
    }
}
