@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a 
                href="{{ route('tasks.index', ['id' => $folder->id]) }}" 
                class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
                {{ $folder->title }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
                タスクモンスターを追加する
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th></th>
              <th>タイトル</th>
              <th>討伐期限</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              @foreach($tasks as $task)
                <tr>
                  <td><img src="{{ $task->image_path }}" width="40" height="40"></td>
                  <td><b>{{ $task->title }}</b>モンスター</td>
                  <td>{{ $task->formatted_due_date }}</td>
                  <td><form action="{{ action('TaskController@destroy', ['id' => $current_folder_id, 'task_id' => $task->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">討伐</button>
                      </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection