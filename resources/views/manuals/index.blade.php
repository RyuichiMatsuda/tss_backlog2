@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('マニュアル一覧') }}</div>
            

            <table class="table table-striped">
                <thead class="thead-dark">
                  <tr><th>タイトル</th><th>作成日</th><th colspan="2">概要</th><th colspan="2"></th></tr>
                </thead>
                <tbody>
                    @foreach ($manuals as $manual)
                        <tr>
                            <td>{{ $manual->title }}</td>
                            <td>{{ $manual->created_at }}</td>
                            <td colspan="4">{{ $manual->strlength() }}</td>
                            
                            <td><a href="{{ route('manuals.detail', ['id' => $manual->id]) }}"　class="btn btn-outline-primary btn-sm">詳細</a></td>
                            
                            <td>
                                <form method="POST" action="{{ route('manuals.destroy') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value= "{{$manual->id}}">
                                    <input type="submit" value="削除" class="btn btn-danger post_del_btn" onclick="return confirm('削除しますか ?');">
                                </form>
                            </td>

                            {{-- <td><a class="btn btn-outline-primary btn-sm">編集</a></td> --}}
                        </tr>
                    @endforeach

                </tbody>
              </table>

              
              <p><a href="{{ route('manuals.new') }}">新規マニュアル登録へ</a></p>

            </div>
        </div>
    </div>
</div>
@endsection
