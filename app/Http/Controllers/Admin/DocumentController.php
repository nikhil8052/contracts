<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use Illuminate\Support\Str;
class DocumentController extends Controller
{
    public function documents(){

        $categories  = DocumentCategory::all();
        
        return view('admin.documents.document',compact('categories'));
    }

    public function addDocuments(Request $request){
        dd($request->all());
    }

    public function addDocumentCategory()
    {
        $categorys =  DocumentCategory::all();
        return view('admin.documents.add_document_category',compact('categorys'));
    }
    public function categoryProcess(Request $request)
    {
      
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category = $request->id ? DocumentCategory::find($request->id) : new DocumentCategory();

        // If the category is not found and an ID was provided, return an error
        if ($request->id && !$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Assign values to the category
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();

        // Redirect with success message
        $message = $request->id ? 'Update category successfully' : 'New category added successfully';
        return redirect()->route('add.category')->with('success', $message);
        }

    public function editCategory($id)
    {
        $category = DocumentCategory::find($id);
        return view('admin.documents.edit_document_category',compact('category'));
    }

}
