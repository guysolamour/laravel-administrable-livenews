@extends(back_view_path('layouts.base'))

@section('title', Lang::get('administrable-livenews::translations.default.edition'))

@section('content')

<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4">
                       <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route(config('administrable.guard') . '.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ back_route('extensions.livenews.livenews.index') }}">{{ Lang::get('administrable-livenews::translations.label') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a>{{ Str::limit(strip_tags($livenews->content), 20) }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-livenews::translations.default.edition') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">{{ Lang::get('administrable-livenews::translations.default.edition') }}</h3>
                        <div class="btn-group float-right">
                            <a href="{{ back_route('extensions.livenews.livenews.destroy', $livenews) }}" class="btn btn-danger" data-method="delete"
                                data-confirm="{{ Lang::get('administrable-livenews::translations.view.destroy') }}">
                                <i class="fas fa-trash"></i> {{ Lang::get('administrable-livenews::translations.default.delete') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('administrable-livenews::' . Str::lower(config('administrable.back_namespace')) . '.livenews._form', ['edit' => true])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection





