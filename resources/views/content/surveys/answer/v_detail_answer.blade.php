<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>
        {{ $category['name'] }}
    </title>

    <style>
        /* Styling the Body element i.e. Color,
        Font, Alignment */
        body {
            background: linear-gradient(to right, rgb(5 63 183 / 91%) 0%, rgb(85 148 232) 100%);
            font-family: Verdana;
        }

        /* Styling the Form (Color, Padding, Shadow) */
        form {
            background-color: #fff;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px 20px;
            box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
        }

        /* Styling form-control Class */
        .form-control {
            text-align: left;
            margin-bottom: 25px;
            border: none;
        }

        /* Styling form-control Label */
        .form-control label {
            display: block;
            margin-bottom: 10px;
        }

        /* Styling form-control input,
        select, textarea */
        .form-control input,
        .form-control select,
        .form-control textarea {
            border: 1px solid #777;
            border-radius: 2px;
            font-family: inherit;
            padding: 10px;
            display: block;
            width: 95%;
        }

        /* Styling form-control Radio
        button and Checkbox */
        .form-control input[type="radio"],
        .form-control input[type="checkbox"] {
            display: inline-block;
            width: auto;
        }
    </style>
</head>

<body>
    <form id="form" action="{{ route('admin.answer.store') }}" method="POST">
        @csrf
        <div class="bg-primary bg-gradient p-3" style="margin: -20px">
            <h3 class="mb-0 text-white">{{ $category['name'] }}</h3>
            <input type="hidden" name="id_category" value="{{ $category['id'] }}">
        </div>
        <br>
        <div class="my-3"></div>
        @php
            $no = 1;
        @endphp
        @foreach ($surveys as $survey)
            @if ($survey['type'] == 'option')
                <div class="form-control" style="margin-bottom : 0px">
                    <label style="">{{ $survey['question'] }}</label>
                </div>
                <div class="row justify-content-around align-items-center" style="margin-bottom: 25px;">
                    <p style="width: 25%" class="text-center mb-0">{{ end($options) }}</p>
                    <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                        @foreach ($options as $key => $option)
                            <label> <input type="radio" disabled {{ $key == $survey['value'] ? 'checked' : '' }}
                                    class="option-input radio r" name="val-{{ $no }}"></label>
                        @endforeach
                    </div>
                    <p style="width: 25%" class="text-center mb-0">{{ reset($options) }}</p>
                </div>
                <hr>
            @else
                <div class="form-control">
                    <label for="comment">
                        {{ $survey['question'] }}
                    </label>
                    <textarea name="val-{{ $no }}" placeholder="Enter your comment here" readonly>{{ $survey['answer'] }}</textarea>
                </div>
                <hr>
            @endif
            @php
                $no++;
            @endphp
        @endforeach
        <input type="hidden" name="amount" value="{{ count($surveys) }}">
        <div class="text-center">
            <a href="{{ route('survey.category') }}" class="btn btn-danger bg-gradient btn-lg">
                kembali
            </a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
