<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Event;
use Illuminate\Validation\ValidationData;

class EventController extends Controller
{
    //
    public function index()
    {

        return Event::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string',
            'desc' => 'required | string'
        ]);

        return Event::create($request->all());
    }

    public function showEvent($id,)
    {
        return Event::find($id);
    }


    public function update(Request $request, $id)
    {   
        $event = Event::find($id);
         $event-> update($request->all());
         return $event;
    }

    public function delete($id){
      
        return Event::destroy($id);
    }
}
