<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact as Model;
use App\Models\Address as Address;
use Carbon\Carbon;

class ContactController extends Controller
{
    // Get all Contacts
    public function getContactIndex() {
        $contacts = Model::paginate(10);
        return response()->json($contacts);
    }
    // Get a Contact
    public function getContact(Request $request, Model $contact) {
        if (empty($contact)) {
            return response()->json(['errors' => 'Contact not found']);
        }
        return response()->json($contact);
    }
    // create contact
    public function postContact(Request $request) {
        // validate
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
    // edit contact
    public function putContact(Request $request, Model $contact) {
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
            // Contact update
            $pkg = $request->all();
            $pkg['birthday'] = \Carbon\Carbon::parse($request->birthday)->format('Y-m-d');

            $contact->fill($pkg);
            $contact->save();
            return response()->json($contact);
    }
    // delete Contact
    public function deleteContact(Request $request, Model $contact) {
            if (empty($contact)) {
                return response()->json(['errors' => 'Contact not found']);
            }
            $contact->addresses()->delete();
            $contact->delete();
            return response()->json(['success' => true]);
    }

    // Addresses
    public function getAddressIndex(Request $request) {
        $currentContact = getContact($request->id);
        return response()->json($currentContact);

    }

    // Get a Contact
    public function getAddress(Request $request, Address $address) {
        if (empty($address)) {
            return response()->json(['errors' => 'Address not found']);
        }
        return response()->json($address);
    }
    public function postAddress(Request $request) {
        // need to get validation working
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        // // Create item
        $pkg = $request->all();
        return response()->json(Address::create($pkg));
    }

    public function putAddress(Request $request, Address $address) {
        if (empty($address)) {
            return response()->json(['errors' => 'Address not found']);
        }
        // validate
        // $validator = Validator::make($request->all(), [
        //     'number' => 'required',
        //     'Street' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zip' => 'required',
        //     'type' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()]);
        // }
        // Mass assignment update
        $pkg = $request->all();
        $address->fill($pkg);
        $address->save();
        return response()->json($address);
    }

    public function deleteAddress(Request $request, Address $address) {
        if (empty($address)) {
            return response()->json(['errors' => 'Address not found']);
        }
        $address->delete();
        return response()->json(['success' => true]);
    }
}
