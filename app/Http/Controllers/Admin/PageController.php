<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Page;
use App\Category;
use App\Tag;
use App\Photo;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pages = Page::all();

      return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      $tags = Tag::all();
      $photos = Photo::all();

      return view('admin.pages.create', compact('categories', 'tags', 'photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($request->all());
        $validator = Validator::make($request->all(), [
           'title' => 'required|max:255',
           'body' => 'required',
           'category_id' => 'required|exists:categories,id', // deve esistere nella TAB categories ID
           'tags' => 'array', // il campo deve essere un array
           'photos' => 'required|array',
           'tags.*' => 'exists:tags,id', // prende tutti VAL dell'Array  e con un chiamata al DB controlla la loro esistenza / ovviamente nella TAB photo dentro la COL ID
           'photos.*' => 'exists:photos,id'

       ]);

       if ($validator->fails()) {
           return redirect()->route('admin.pages.create')
                       ->withErrors($validator)
                       ->withInput();
       }

       $page = new Page; // creo nuova instanza
       $data['slug'] = Str::slug($data['title'] , '-');
       $data['user_id'] = Auth::id(); // prendiamo ID dell'utente collegato
       $page->fill($data); // nel fillable mancheranno le relazioni many to many
       $saved = $page->save();
       if (!$saved) {
         dd('error');
       }

       // INSERIAMO LE RELAZINI
       // tags e photos con le () perche' restituisce una chiamata ELOQUENT, senza parentesi sarebbe una collection
       $page->tags()->attach($data['tags']);
       $page->photos()->attach($data['photos']);

       return redirect()->route('admin.pages.show', $page->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // enra l id dalla FUNC store
    {
      $page = Page::findOrFail($id); // cerco il record con l'id

      return view('admin.pages.show', compact('page')); // passo alla VIEW con il compact il mio record
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $page = Page::findOrFail($id); // cerco il record con l'id al posto della create che non serve

      $categories = Category::all();
      $tags = Tag::all();
      $photos = Photo::all();

      return view('admin.pages.edit', compact('categories', 'tags', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
