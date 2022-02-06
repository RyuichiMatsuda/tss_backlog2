@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('インシデント一覧') }}</div>


                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>名前</th>
                            <th>ステータス</th>
                            <th>作成日</th>
                            <th colspan="2">概要</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidents as $incident)
                        <tr>
                            <td>{{ $incident->title }}</td>
                            <td>{{ config('status')[$incident->status_id] }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td colspan="4">{{ $incident->strlength() }}</td>

                            <td><a href="{{ route('incidents.detail', ['id' => $incident->id]) }}"
                                    class="btn btn-outline-primary btn-sm">詳細</a>
                                <button class="sample_ajax_button" ajax_id="{{ $incident->id}}">tes</button>
                            </td>
                            {{--
                            <td><a class="btn btn-outline-primary btn-sm">編集</a></td>
                            <td>
                                <form th:action="@{/book/delete}" method="post">
                                    <button class="delete-action btn btn-outline-danger btn-sm"
                                        type="submit">削除</button>
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="version">
                                </form>
                            </td>
                            --}}
                            <td>
                                <form method="POST" action="{{ route('incidents.destroy') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$incident->id}}">
                                    <input type="submit" value="削除" class="btn btn-danger post_del_btn"
                                        onclick="return confirm('削除しますか ?');">
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <p><a href="{{ route('incidents.new') }}">新規インシデント登録へ</a></p>

            </div>

            <div id="change_card" class="change_card">


            </div>
        </div>
    </div>
    @endsection