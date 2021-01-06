<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Todo;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Todo $todo)
    {
        $todos = Todo::all();
        return response()->json($todos,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Todo $todo)
    {
        $validator = Validator::make($request->all(),[
            'body'=> 'required'
        ]);
        if($validator->fails()){
            $response = array('response'=> $validator->errors(), 'success' => false);
            return  $response;
        }
        else{

        $todo = new Todo;
        $todo->body = $request->input('body');

        $todo->save();

        return response()->json([ 'message' => 'Todo Successfully added'],200);

        }


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = Validator::make($request->all(),[
            'body'=> 'required'
        ]);
        if($validator->fails()){
            $response = array('response'=> $validator->errors(), 'success' => false);

            return  $response;
        }
        else{
            // Create Items
        $todo = Todo::find($todo);

        $todo->body = $request->input('body');

        $todo->save();

        return response()->json($todo,200);
    }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Todo $todo)
    {
       $todo =  Todo::find($id);

        $todo->delete();

        $response = array('response'=> 'Todo deleted', 'success' => true);
        return  $response;

    }
}
