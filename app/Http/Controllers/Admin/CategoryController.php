<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.pCategory.home', compact('categories'));
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
            'cName' => 'required|max:50',
            'pCategory' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'cName.required' => 'Please insert a category name',
            'cName.max' => 'Cannot insert more than 50 characters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'name' => ucfirst($request->cName),
            'parent_id' => $request->pCategory,
            'status' => $request->status
        ];
        Category::create($data);
        session()->flash('success', $request->cName.' added successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return json_encode($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'name' => ucfirst($request->cNameEdit),
            'parent_id' => $request->pCategoryEdit,
            'status' => $request->statusEdit
        ];

        try {
            Category::where("id", $request->cId)->update($data);

            $notification=[
                'message'   =>  'Data successfully updated',
                'alert-type'    =>  'success'
            ];
        } catch (Exception $e) {
            $notification=[
                'message'   =>  'Something wrong happend',
                'alert-type'    =>  'error'
            ]; 
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where("id", $id)->delete();
        return json_encode("data successfully deleted");
    }
}
