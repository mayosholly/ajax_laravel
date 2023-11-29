<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(){
        return view('index');
    }

    public function create(){
        $items = Item::paginate();
        return response()->json([
            'items' => $items
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()->toArray()
            ]);
        }else{
            $file = $request->file('image');
            $fileName = time(). '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }
        $items = new Item();
        $items->name = $request->name;
        $items->image = $fileName;
        $items->save();
        return response()->json([
            'status' => 201,
            'message' => 'Successfully Created'
        ]);
    }

    public function ajaxEdit(Request $request){
        $id = $request->id;
        $item = Item::find($id);
        return response()->json($item);
    }

    public function ajaxUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()->toArray()
            ]);
        }else{
            $fileName = '';
            $item = Item::find($request->item_id);
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = time(). '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $fileName);
                if($item->image){
                    Storage::delete('public/images/', $item->image);
                }    
            }else{
                $fileName = $request->item_image;
            }
            $itemData = [
                'name' => $request->name,
                'image' => $fileName
            ];
            $item->update($itemData);
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Updated'
            ]);
            }
        }
    
        public function ajaxDelete(Request $request){
            $id = $request->id;
            $item = Item::find($id);
            if(Storage::delete('public/images/'. $item->image)){
                Item::destroy($id);
            }
        }

}

