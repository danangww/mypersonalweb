<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Category;

class Test extends Controller
{
    public function index()
    {
        $portofolio = Portfolio::find(1)->category->name;
        dd($portofolio);
    }

    public function category()
    {
        $category = Category::find(1);
        // from collection -> get all data baru filter
        $data = $category->portfolios->where('title', 'like', '%1');

        // filter data dari database baru get as collection
        $data = $category->portfolios()->where('title', 'like', '%1');
        dd($data);
    }
}
