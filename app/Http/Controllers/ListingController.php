<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class ListingController extends Controller
{
    // show all listing
    public static function index(Request $request){
        return view("listings.index",[
            "heading" => "latest listing",
            "listings" => Listing::latest()->filter(request(["tag","search"]))->paginate(4)
         ]);
    }

    // show single listing
    public static function show (Listing $listing){
        // using ddata model binding
        return view("listings.show", ["listing" => $listing]);
    }

    // show page to create a listing
    public static function create(){
        return view("listings.create");
    }

    // show page to create a listing
    public static function store(Request $request){
        $formfileds = $request->validate([
            "title" => "required",
            "company" => ["required", Rule::unique("listings","company") ],
            "location" => "required",
            "website" => "required",
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required",
            "city" => "required"
            
        ]);

        $formfileds["user_id"] = auth()->id();

        if($request->hasFile("logo")){
            $formfileds["logo"] = $request->file("logo")->store("logos","public", $name='photo'.auth()->id());

        }
                Listing::create($formfileds);
        return redirect("/")->with("message","listing created succesfully");
    }

    // show listing edit page
    public static function edit (Listing $listing){
      // using ddata model binding 
      return view("listings.edit", ["listing" => $listing]);
    }

    // show listing edit page
    public static function update (Request $request, Listing $listing ){
        if($listing->user_id != auth()->id()){
                abort(403,"unauthorized action");
        }
        // dd($request->file('logo'));
        $formfileds = $request->validate([
            "title" => "required",
            "company" => "required",
            "location" => "required",
            "website" => "required",
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required",
            "city" => "required"
            
        ]);
      
        if($request->hasFile("logo")){
            $formfileds["logo"] = $request->file("logo")->store("logos","public", $name='photo'.auth()->id());
            // dd($formfileds['logo']);
        }

        $listing->update($formfileds);
        return redirect("/")->with("message","listing updated succesfully");
    }
    // delete listing 
    public static function delete (Request $request, Listing $listing ){
        if($listing->user_id != auth()->id()){
            abort(403,"unauthorized action");
        }
      
        $listing->delete();
        return redirect("/")->with("message", "listing deleted");
    }

    // manage listing
    public function manage(){
        // dd(auth()->user()->listings()); 
        // return view("listings.manage",["listings" => auth()->user()->listings()->get()]);
        $user = User::find(auth()->id());
        return view("listings.manage",["listings" => $user->listings()->get()]);
    }
}
