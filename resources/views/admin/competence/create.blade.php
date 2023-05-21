@extends('layouts/contentNavbarLayout')

@section('title', 'Competences')

@section('page-style')
    <style>
        .border-ipt{
            border: 1px solid #ddd;
        }
    </style>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Créer une compétence</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('competence') }}">
                    @csrf
                    <!-- Account -->
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12  ">
                                <label for="firstName" class="form-label">Nom</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Type</label>
                                <select id="type" name="type" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="Informatique">Informatique</option>
                                    <option value="Logistic">Logistic</option>
                                    <option value="Communication">Communication</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Niveau</label>
                                <select id="niveau" name="niveau" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermediare">Intermediare</option>
                                    <option value="Expert">Expert</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Enregister</button>
                            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                        </div>
                    </div>
                    <!-- /Account -->
                </form>
            </div>
        </div>
    </div>
@endsection
