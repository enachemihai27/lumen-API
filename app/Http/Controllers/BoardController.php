<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
    public function index (){
        return Board::all();
    }

    public function store(Request $request){
        try{
            $board = new Board();
            $board->name = $request->name;
            $board->list_users = $request->list_users;

            if ($board->save()){
                return response()->json(['status' => 'succes', 'message' => 'Board created successfully']);
            }
        } catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        } 
    }   
        public function update(Request $request, $id){
            try{
                $board =Board::findOrFail($id);
                $board->name = $request->name;
                $board->list_users = $request->list_users;

    
                if ($board->save()){
                    return response()->json(['status' => 'succes', 'message' => 'Board updated successfully']);
                }
            } catch(\Exception $e){
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }

        public function destroy ($id){
            try{
                $board =Board::findOrFail($id);
                if ($board->delete()){
                    return response()->json(['status' => 'succes', 'message' => 'Board deleted successfully']);
                }
            } catch(\Exception $e){
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    



}
