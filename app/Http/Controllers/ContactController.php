<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    } //End Method

    public function AdminAddContact(){
        return view('admin.contact.create');
    } //End Method

    public function AdminStoreContact(Request $request){
       Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('admin.contact')->with('success','Contact Inserted Successfully');

    } //End Method

    public function EditAdminContact($id){
        $contacts = Contact::find($id);
       return view('admin.contact.edit',compact('contacts'));
    } // End Method

    public function UpdateAdminContact(Request $request, $id){
        Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('admin.contact')->with('success','Contact Updated Successfully');  
    } // End Method

    public function DeleteAdminContact($id){
        $delete = Contact::find($id)->delete();
        return Redirect()->back()->with('success','Message Deleted Successfully');
      } // End Method

    public function Contact(){
        $contacts = DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }//End Method

    public function ContactForm(Request $request){
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('contact')->with('success','Your Message Send Successfully');

    } //End Method

    public function AdminMessag(){
        $messages = ContactForm::all();
        return view('admin.contact.message',compact('messages'));
    }//End Method

    public function DeleteMessage($id){
        $delete = ContactForm::find($id)->delete();
        return Redirect()->back()->with('success','Message Deleted Successfully');
      } // End Method
}
