<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Models\Contact;
use App\Models\CustomAttribute;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function mapping(ImportRequest $request)
    {
        $filePath = $request->file('csv')->getRealPath();
        $fileName = $request->file('csv')->getClientOriginalName();

        $csvData = array_map('str_getcsv', file($filePath));

        // separate csv header and data
        $csvHeader = array_slice($csvData, 0, 1);
        $csvDataFileds = array_slice($csvData, 1);

        //temporary save csv data in session
        $request->session()->put('csvData', $csvDataFileds);
        $request->session()->put('csvHeader', $csvHeader);

        $contactColumns = Contact::CONTACT_COLUMNS;

        return view('import.mapping', compact('csvHeader', 'contactColumns', 'csvDataFileds', 'fileName'));
    }

    public function preview(Request $request)
    {
        $csvData = $request->session()->get('csvData');
        $csvHeader = $request->session()->get('csvHeader');

        $contactColumns = Contact::CONTACT_COLUMNS;
        $mappedFields = $request->input('fields');

        //union mapped fields with csv data
        $mappedArray = [];
        $customAttributes = [];
        foreach ($csvData as $dKey => $data) {
            foreach ($mappedFields as $mKey => $field) {
                $mappedArray[$dKey][$field] = $data[$mKey];
                if (!in_array($field, $contactColumns)) {
                    unset($mappedArray[$dKey][$field]); // unset not mapped fields from array
                    $customAttributes[$dKey]['key'] = $field;
                    $customAttributes[$dKey]['value'] = $data[$mKey];
                }
            }
        }

        //temporary save csv data in session
        $request->session()->put('mappedArray', $mappedArray);
        $request->session()->put('customAttributes', $customAttributes);

        return view('import.preview', compact('mappedArray', 'contactColumns', 'customAttributes'));
    }

    public function save(Request $request)
    {
        $mappedArray = $request->session()->get('mappedArray');
        $customAttributes = $request->session()->get('customAttributes');

        foreach ($mappedArray as $key => $data) {
            $contact = new Contact();
            $contact->fill($data);
            $contact->save();

            //save custom attributes , TODO refactor save via relation
            if (isset($customAttributes[$key])) {
                $customAttribute = new CustomAttribute();
                $customAttribute->contact_id = $contact->id;
                $customAttribute->key = $customAttributes[$key]['key'];
                $customAttribute->value = $customAttributes[$key]['value'];
                $customAttribute->save();
            }
        }

        return redirect()->route('index');
    }
}
