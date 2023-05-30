<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Portfolio::all();

        return view('portfolios.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('portfolios.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image_file' => 'required|image',
        ]);

        $imagePath = $request->file('image_file')->store('uploads', ['disk' => 'public']);

        $newPortfolio = new Portfolio();
        $newPortfolio->category_id = $request->category;
        $newPortfolio->title = $request->title;
        $newPortfolio->description = $request->description;
        $newPortfolio->image_file_url = '/storage/' . $imagePath;
        $newPortfolio->save();

        session()->flash('flash_notification', [
            'level' => 'success',
            'message' => 'Portfolio added successfully'
        ]);

        return redirect()->route('portfolios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Portfolio::findOrFail($id);
        $categories = Category::all();

        return view('portfolios.edit', compact(
            'data',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image_file' => 'nullable|image',
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->category_id = $request->category;
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;

        if ($request->hasFile('image_file')) {
            // delete old image
            File::delete($portfolio->image_file_url);

            // and store new image
            $imagePath = $request->file('image_file')->store('uploads', ['disk' => 'public']);
            $portfolio->image_file_url = $imagePath;
        }

        $portfolio->save();

        session()->flash('flash_notification', [
            'level' => 'success',
            'message' => 'Portfolio updated successfully'
        ]);

        return redirect()->route('portfolios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // delete portfolio's image
        File::delete($portfolio->image_file_url);

        $portfolio->delete();

        session()->flash('flash_notification', [
            'level' => 'success',
            'message' => 'Portfolio deleted successfully'
        ]);

        return redirect()->route('portfolios.index');
    }
}
