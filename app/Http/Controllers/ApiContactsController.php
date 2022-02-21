<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact as Model;

class ApiContactsController extends Controller
{
    // Retrieve list of items from the database
    public function getIndex(Request $request) {
        return response()->json(Model::orderBy('lastName')->get());
    }

    // Retrieve details of a specific item from the database
    public function getItem(Request $request, Model $contact) {
        if (empty($contact)) {
            return response()->json(['errors' => 'Contact not found']);
        } 
        return response()->json($contact);
    }   
    
    // Save changes to a given item
    public function putItem(Request $request, Model $contact) {
        if (empty($contact)) {
            return response()->json(['errors' => 'Contact not found']);
        } 
        
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        
        // Mass assignment update
        $pkg = $request->all();
        $pkg['birthday'] = \Carbon\Carbon::parse($request->birthday)->format('Y-m-d');

        $contact->fill($pkg);
        $contact->save();
        return response()->json($contact);
    }

    // Create new item in the database
    public function postItem(Request $request) {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // Create item
        $pkg = $request->all();
        $pkg['birthday'] = \Carbon\Carbon::parse($request->birthday)->format('Y-m-d');

        return response()->json(Model::create($pkg));

    }

    // Delete/remove item from the database
    public function deleteItem(Request $request, Model $contact) {
        if (empty($contact)) {
            return response()->json(['errors' => 'Contact not found']);
        } 
        $contact->delete();
        return response()->json(['success' => true]);
    }

}
