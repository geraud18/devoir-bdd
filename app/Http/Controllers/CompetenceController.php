<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Competence;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompetenceController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {

            $query =Competence::query();
            $query->select([
                'competences.id',
                'competences.name',
                'competences.type',
                'competences.niveau',
                'competences.userId',
            ]);

            $query->where('competences.userId',Auth::user()->id);
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button type="button" class="btn btn-sm btn-primary edit-modal" data-toggle="modal" data-target="#editModal" data-id="'.$row->id.'">Modifier</button>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="'.$row->id.'">Supprimer</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.competence.index');
    }

    public function formCompetence(){
        return view('admin.competence.create');
    }

    public function Create(Request $request){
        $messages = [
            'name.required'=>'Nom obligatoire',
            'type.required'=>'Type obligatoire',
            'niveau.required'=>'Niveau obligatoire',
        ];

        $request->validate([
            'name' => ['required'],
            'type' => ['required'],
            'niveau' => ['required']
        ],$messages);

        Competence::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'niveau' => $request->input('niveau'),
            'userId' => Auth::user()->id,
        ]);

        return Redirect::route('competence')->with('status', 'Compétence Ajouter');
    }
}
