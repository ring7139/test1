<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        session(['contact' => $contact]);

        $categories = Category::all();

        return view('confirm', compact('contact', 'categories'));
    }

    public function store()
    {
        $data = session('contact');

        $genderMap = [
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
        ];
        $gender = $genderMap[$data['gender']] ?? 3;



        Contact::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'gender' => $gender,
            'email' => $data['email'],
            'tel' => $data['tel'],
            'address' => $data['address'],
            'building' => $data['building'],
            'category_id' => $data['category_id'],
            'detail' => $data['detail'],
        ]);

        session()->forget('contact');

        return view('thanks');
    }

    public function edit()
    {
        $contact = session('contact');
        $categories = Category::all();

        if ($contact && isset($contact['tel'])) {

            $contact['tel1'] = substr($contact['tel'], 0, 3);
            $contact['tel2'] = substr($contact['tel'], 3, 4);
            $contact['tel3'] = substr($contact['tel'], 7, 4);

            return view('index', compact('contact', 'categories'));
        }
    }
}
