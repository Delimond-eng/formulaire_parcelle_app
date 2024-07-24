@extends('layouts.app')

@section('content')
    <div id="form_container">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <div id="wizard_container">
                    <!-- /top-wizard -->
                    <form id="wrapped" method="post" action="{{ route('parcelle.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}, le numéro d'identification est : <strong>{{ session('npi') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div id="middle-wizard">
                            <div class="container-fluid">
                                <h3 class="main_question ml-2"><i class="arrow_right"></i>Veuillez renseigner les champs requis !</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="border p-3 mb-1">
                                           <div class="fields-group" id="proprietaire-section">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="type">Identification *</label>
                                                        <select name="proprietaires[0][type_proprietaire]" class="form-control">
                                                            <option value="Propriétaire">Propriétaire</option>
                                                            <option value="Co-Propriétaire">Co-Propriétaire</option>
                                                            <option value="Héritier">Héritier</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Numéro d'Identification Nationale *</label>
                                                        <input type="text" placeholder="Entrez le NPI..." class="form-control" id="npi_proprietaire_0" name="proprietaires[0][npi_proprietaire]">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="assureur">Identité <sup class="text-primary">infos de NPI</sup></label>
                                                        <input type="text" class="form-control" id="identite_proprietaire_0" readonly>
                                                    </div>
                                                </div>
                                           </div>
                                            <button type="button" class="btn btn-secondary btn-sm add-proprietaire-button">
                                                <i class="icon-plus-1"></i> Ajouter
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="forme_geometrique">Forme *</label>
                                        <select name="forme_geometrique" id="forme_geometrique" class="form-control" required>
                                            <option value="" selected hidden>Sélectionnez une forme géometrique...</option>
                                            @foreach ($formes as $forme)
                                                <option value="{{ $forme }}">{{ $forme }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="formes-draw">
                                        <canvas id="shapeCanvas" width="80" height="80"></canvas>
                                    </div>

                                    <div id="dimensionsSection" class="form-group col-md-8 d-none">
                                        <label>Entrez la valeur pour chaque côté en mètre !</label>
                                        <input type="text" class="form-control position-absolute" id="dimensions" name="dimensions" required style="visibility: hidden">
                                        <div id="dimensionsInputs" class="row"></div>
                                    </div>

                                    <div class="col-md-4 col-6">
                                        <div class="form-group radio_input">
                                            <label for="etage">Etage :</label>
                                            <label class="container_radio mr-3">Non
                                                <input type="radio" id="etageNon" checked name="etage" value="non">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container_radio">Oui
                                                <input type="radio" id="etageOui" name="etage" value="oui">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group d-none col-md-4 col-6" id="nbre_etages_group">
                                        <label for="nbre_etages">Nombre d'étages **</label>
                                        <select name="nbre_etages" class="form-control" id="etages">
                                            <option value="" selected hidden>Sélectionnez nbre étages...</option>
                                            @for ($i=0; $i<50; $i++)
                                            <option value="R+{{ $i+1 }}">R+{{ $i+1 }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="titreSelect">Type de titre **</label>
                                        <select name="type_titre" id="titreSelect" class="form-control">
                                            <option value="" selected hidden>Sélectionnez un titre...</option>
                                            @foreach ($titres as $titre)
                                                <option value="{{ $titre }}">{{ $titre }}</option>
                                            @endforeach
                                            <option value="Autre">Autre</option>
                                        </select>
                                        <div class="input-group d-none" id="otherTitleGroup">
                                            <input type="text" name="type_titre" class="form-control" id="otherTitleInput" placeholder="Entrez autre titre...">
                                            <div class="input-group-append">
                                                <button class="btn btn-info" type="button" id="toggleButton"><i class="arrow_carrot-down text-center text-white"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="numero_titre">Numéro de titre **</label>
                                        <input type="text" class="form-control" id="numero_titre" name="numero_titre" placeholder="Entrez le numéro de titre" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nbre_maisons_location">Nombre de maisons en location</label>
                                        <input type="number" class="form-control" id="nbre_maisons_location" name="nbre_maisons_location" placeholder="Entrez le nombre de maisons en location">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Province *</label>
                                        <select class="form-control" id="province_id" name="province_id" required>
                                            <option value="" hidden selected>Sélectionner une province</option>
                                            @foreach ($provinces as $p )
                                                <option value="{{ $p->id }}">{{ $p->province_libelle }}</option>
                                            @endforeach
                                            <!-- Options dynamiques -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Ville *</label>
                                        <select class="form-control" id="ville_id" name="ville_id" required>
                                            <option value="" selected hidden>Sélectionner une ville</option>
                                            <!-- Options dynamiques -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Commune *</label>
                                        <select class="form-control" id="commune_id" name="commune_id" required>
                                            <option value="" selected hidden>Sélectionner une commune</option>
                                            <!-- Options dynamiques -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Quartier *</label>
                                        <select class="form-control" id="quartier_id" name="quartier_id" required>
                                            <option value="" selected hidden>Sélectionner un quartier</option>
                                            <!-- Options dynamiques -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Adresse*</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="numéro & avenue... ex:03, Bismark" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="description">Description de la construction existante **</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Entrez la description" required></textarea>
                                    </div>

                                    <div class="col-md-12 d-none" id="section-cols">
                                        <div class="form-section">
                                            <h5 class="mb-2">Maisons de location</h5>
                                            <div id="maison-content"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row-->
                            </div>
                            <!-- /step-->
                        </div>
                        <!-- /middle-wizard -->
                        <div style="display: flex; justify-content: end;" class="mr-2">
                            <button type="reset" class="btn btn-secondary btn-lg mr-3">Annuler</button>
                            <button type="submit" class="btn btn-success btn-lg"><i class="icon-check-3"></i> Soumettre</button>
                        </div>
                        <!-- /bottom-wizard -->
                    </form>
                </div>
                <!-- /Wizard container -->
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Form_container -->
@endsection

@section("scripts")
<script src="{{ asset('assets/js/form_manager.js') }}"></script>
<script src="{{asset('assets/js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: "Le Numéro d'Identification Provinciale est : {{ session('npi') }}",
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        @endif
    });
</script>
@endsection
