@extends('layouts/contentNavbarLayout')

@section('title', 'Mon compte')

@section('page-script')
    <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                if ($(this).val() === 'Entreprise') {
                    $('#society-name').show();
                } else {
                    $('#society-name').hide();
                }
            });
        });
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Mon compte</span>
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
            </ul>
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
                <h5 class="card-header">Profile Details</h5>
                <form id="formAccountSettings" enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if(!empty($user->image))
                            <img src="{{asset('images/'.$user->image)}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        @else
                            <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        @endif
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Mettre a jour votre photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="image" value="{{old('image', $user->image)}}"  class="account-file-input" hidden accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Extension autorisé JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nom</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{old('name', $user->name)}}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Prénom</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value="{{old('lastName', $user->lastName)}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{old('email', $user->email)}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Numéro de téléphone</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">FR (+33)</span>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{old('phoneNumber', $user->phoneNumber)}}"/>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address', $user->address)}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">Ville</label>
                                <input class="form-control" type="text" id="state" name="state" value="{{old('state', $user->state)}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" maxlength="6" value="{{old('zipCode', $user->zipCode)}}"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Type</label>
                                <select id="type" name="type" class="select2 form-select">
                                    <option value="">Select</option>
                                    <option @if($user->type == "Particulier") selected @endif value="Particulier">Particulier</option>
                                    <option @if($user->type == "Entreprise") selected @endif value="Entreprise">Entreprise</option>
                                </select>
                            </div>
                            @if($user->type == "Entreprise")
                            <div class="mb-3 col-md-12" id="society-name">
                                <label for="society" class="form-label">Nom de la societé</label>
                                <input type="text" class="form-control" id="society" name="society"  value="{{old('society', $user->society)}}"/>
                            </div>
                            @else
                                <div class="mb-3 col-md-12" style="display: none" id="society-name">
                                    <label for="society" class="form-label">Nom de la societé</label>
                                    <input type="text" class="form-control" id="society" name="society" value="{{old('society', $user->society)}}" />
                                </div>
                            @endif

                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Enregister</button>
                            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                        </div>
                </div>
                <!-- /Account -->
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
@endsection

