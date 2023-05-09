@extends('admin.base')

@section('title', 'Admin: Import')

@section('style')
    <link href="/style/admin/import.css" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <h2>Import Data</h2>

    <form method="POST" action="{{ route('admin.import.process') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="importType">
                Select Import Type:
                <div class="info-button" onclick="show_info();">
                    <span>i</span>
                </div>
            </label>
            <select class="form-control" id="importType" name="importType">
                <option value="authors">Форма 1: Авторы</option>
                <option value="book_product">Форма 3: Товар-Книга</option>
                <option value="xxx">Фоqwwqeар-Книга</option>
            </select>
        </div>
        <div class="form-group">
            <label for="importFile">Select File:</label>
            <input type="file" class="form-control-file" id="importFile" name="importFile" accept=".csv">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Import</button>
        </div>
    </form>


    <div class="info-dialog" id="info-dialog">
        <a href="#" class="close" onclick="close_info();">&times;</a>
        <h3>Инструкция для импорта</h3>
        <p>Выберите CSV файл, из которого нужно получить данные. Затем выбирите форму данных, которые представленны в файле.</p>
        <p>В CSV файле первая строка должна содержать колонки таблицы (таблиц). Разделение в файле - точка с запятой ';'. Эти колонки должны быть в одной из следующих форм:</p>
        <ul>
            <li>Форма 1: Авторы - name; description; image</li>
            <li>Форма 2: Books - title; author; year; image; publisher; genre; description</li>
            <li>Форма 3: Товар-Книга - title; author; year; image; publisher; genre; oldprice; price; description</li>
            <li>Form 4: Products - title, author_id, published_at</li>
        </ul>
    </div>

    <div class="info-background" id="info-background" onclick="close_info();"></div>


    @if(session('errors'))
        <div class="errors">
            <h3>Ошибки</h3>
            <ul>
            @foreach(session('errors') as $error)
                <li class="error_message">
                    {{ $error }}
                </li>
            @endforeach
            </ul>
        </div>
    @endif

<script>
function show_info() {
    $('#info-dialog').addClass("show");
    $('#info-background').addClass("show");
}

function close_info() {
    $('#info-dialog').removeClass("show");
    $('#info-background').removeClass("show");
}

var success = {{ session('success') }};
if (success) {
  swal({
    title: 'Успех!',
    text: "Записи были добавлены в базу данных без ошибок",
    icon: 'success'
  });
}
</script>


@endsection