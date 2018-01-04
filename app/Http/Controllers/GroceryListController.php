<?php

namespace App\Http\Controllers;

use App\GroceryList;
use Illuminate\Http\Request;
use App\Http\Resources\GroceryList as GroceryListResource;

class GroceryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GroceryListsResource();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		GroceryListResource::withoutWrapping();
        return new GroceryListResource(GroceryList::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function edit(GroceryList $groceryList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroceryList $groceryList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroceryList  $groceryList
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroceryList $groceryList)
    {
        //
    }
}
