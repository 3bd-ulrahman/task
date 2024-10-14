<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  @vite('resources/js/app.js')
</head>

<body>
  <div class="container text-center">
    <div class="row mt-5">
      @foreach ($students as $student)
        <div class="col-4 mb-3">
          <div class="border p-3 rounded">
            <div>{{ $student->name }}</div>
            <img style="width: 200px" src="{{ $student->{'qr-code'} }}" alt="{{ $student->name }}">
            <div>{{ $student->nationality_id }}</div>
          </div>
        </div>
      @endforeach
    </div>
    {{ $students->links() }}
  </div>
</body>

</html>
