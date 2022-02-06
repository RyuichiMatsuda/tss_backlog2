@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    
                    <p>マニュアル新規登録</p>

                    <form method="POST" action="{{ route('manuals.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- 画像登録 --}}
                        <div class="row mb-3">
                            <label for="image_file" class="col-md-4 col-form-label text-md-end">{{ __('画像') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" name="image_file" type="file" accept="image/png, image/jpeg" >

                                @error('image_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- 電話発信者名 --}}
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('タイトル') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- インシデント概要 --}}
                        <div class="row mb-3">
                            <label for="body" class="col-md-4 col-form-label text-md-end">{{ __('本文') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('free_space') }}" required autofocus></textarea>

                                {{-- @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}

                            </div>
                        </div>

                        {{-- 対応社員登録 --}}

                        {{-- 社員名のプルダウンメニュー（今は閉じておく。） S 
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('顧客名') }}</label>                                
                            @if(false)
                            <div class="col-md-6">

                                <select class="form-control" id="employee_id" name="value_category_id" required>
                                    <option value="" hidden>▼対応社員名</option>
                                    @foreach($value_categories as $value_category)
                                        @if($company_value->value_category->id === $value_category->id )
                                            <option value="{{ $value_category->id }}" selected>{{ $value_category->title }}</option>
                                            <option value="{{ $value_category->id }}">{{ $value_category->title }}</option>
                                    @endforeach
                                </select>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endif
                        社員名のプルダウンメニュー（今は閉じておく。） E --}}


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
