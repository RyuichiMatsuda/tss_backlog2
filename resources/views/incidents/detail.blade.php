@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                    <p>インシデント詳細画面</p>

                    <div class="row mb-3">
                        <p>{{ $incident->id }}</p>
                    </div>         

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('電話発信者名') }}</label>

                        <div class="col-md-6">
                            <p>{{ $incident->title }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('インシデント概要') }}</label>

                        <div class="col-md-6">
                            <p>{{ $incident->body }}</p>
                        </div>
                    </div>

                    <p>インシデントステータス: {{ config('status')[$incident->status_id] }}</p>
                    
                    <p><a href="{{ route('incidents.index') }}">一覧ページへ</a></p>
                    <p><a href="{{ route('incidents.new') }}">新規インシデント登録へ</a></p>
                    <p>
                        <form method="POST" action="{{ route('incidents.destroy') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value= "{{$incident->id}}">
                            <input type="submit" value="削除" class="btn btn-danger post_del_btn" onclick="return confirm('削除しますか ?');">
                        </form>
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
