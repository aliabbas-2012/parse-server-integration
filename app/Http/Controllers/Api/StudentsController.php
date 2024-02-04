<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseException;

class StudentsController extends Controller
{
    public function index()
    {
        $data = [];
        $query = new ParseQuery("students");
        $query->descending("updatedAt");
        if($results = $query->find()){
            foreach($results as $model){
                $data[] = ['id' => $model->getObjectId()] + $model->getAllKeys();
            }
        }
        return $data;
    }

    public function create(Request $request)
    {
        $student = new ParseObject("students");
        foreach($request->all() as $column => $value) {
            if(is_array($value)) {
                $student->setArray($column, $value);
            }
            else {
                $student->set($column, $value);
            }
        }
        $student->set('created_by', $request->user->getObjectId());

        try {
            $student->save();
            $response = ['id' => $student->getObjectId()]+ $request->post();
            return response()->json($response, 201);
        } catch (ParseException $ex) {
            // echo used just for testing
            echo  'Failed to create new object, with error message: ' . $ex->getMessage();
            return false;
        }
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request,  $id)
    {
        $query = new ParseQuery("students");
        $student = $query->get($id);
        foreach($request->all() as $column => $value) {
            if(is_array($value)) {
                $student->setArray($column, $value);
            }
            else {
                $student->set($column, $value);
            }
        }
        $student->set('updated_by', $request->user->getObjectId());
        $student->save();
        $response = ['id' => $student->getObjectId()]+ $student->getAllKeys();
        return response()->json($response);
    }

    public function destroy($id)
    {
        $query = new ParseQuery("students");
        $student = $query->get($id);
        $student->destroy();

        return response()->json(null, 204);
    }

}
