@extends('layout')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクモンスター追加</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="due_date">討伐期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
              </div>
               <div class="form-group">
                   <?php
                        $image_rand = array(
                            "/images/monster01.png",
                            "/images/monster02.png",
                            "/images/monster03.png",
                            "/images/monster04.png",
                            "/images/monster05.png",
                            "/images/monster06.png",
                            "/images/monster07.png",
                            "/images/monster08.png",
                            "/images/monster09.png",
                            "/images/monster10.png",
                            "/images/monster11.png",
                            "/images/monster12.png",
                            "/images/monster13.png",
                            "/images/monster14.png",
                            "/images/monster15.png",
                            "/images/monster16.png",
                        );
                         
                        $image_rand = $image_rand[mt_rand(0, count($image_rand)-1)];
                    ?>
                <input type="hidden" class="form-control" name="image_path" id="image_path" value="<?= $image_rand ?>" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">出現</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_date'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script>
@endsection