<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- Demo styles -->
    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        /* .swiper-btn-next{
        background-color: #007aff;
      }

      .swiper-btn-prev{
        background-color: #007aff;
      } */

        .swiper-container {
            position: absolute;
            bottom: 50px;
            color: rgb(37, 39, 39);
            font-size: 40px;
            z-index: 5;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-pagination-bullet {
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            color: #000;
            opacity: 1;
            background: rgba(0, 0, 0, 0.2);
        }

        .swiper-pagination-bullet-active {
            color: #fff;
            background: #007aff;
        }

        /* input */
        @keyframes click-wave {
            0% {
                height: 40px;
                width: 40px;
                opacity: 0.15;
                position: relative
            }

            100% {
                height: 200px;
                width: 200px;
                margin-left: -80px;
                margin-top: -80px;
                opacity: 0
            }
        }

        .option-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            position: relative;
            top: 13.33333px;
            right: 0;
            bottom: 0;
            left: 0;
            height: 30px;
            width: 30px;
            transition: all 0.15s ease-out 0s;
            background: #cbd1d8;
            border: none;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            margin-right: 0.5rem;
            outline: none;
            position: relative;
            z-index: 1000
        }

        .option-input:hover {
            background: #9faab7
        }

        .option-input:checked {
            background: #E91E63
        }

        .option-input:checked::before {
            height: 30px;
            width: 30px;
            position: absolute;
            content: "\f111";
            font-family: "Font Awesome 5 Free";
            display: inline-block;
            font-size: 26.66667px;
            text-align: center;
            line-height: 30px
        }

        .option-input:checked::after {
            -webkit-animation: click-wave 0.25s;
            -moz-animation: click-wave 0.25s;
            animation: click-wave 0.25s;
            background: #E91E63;
            content: '';
            display: block;
            position: relative;
            z-index: 100
        }

        .option-input.radio {
            border-radius: 50%;
            display: block;
            margin: 1.5em auto;
        }

        .option-input.radio::after {
            border-radius: 50%
        }

        .list-group-item {
            cursor: move;
        }

        .prior-section {
            justify-content: center;
            align-items: center;
        }

        .swiper-wrapper.disabled {
            transform: translate3d(0px, 0, 0) !important;
        }

        .swiper-pagination.disabled {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Swiper -->
    <div class="swiper mySwiper" id="swipper">
        <div class="swiper-wrapper">
            {{-- <div class="d-none">
                <button id="swiper-next" class="swiper-next">Click</button>
            </div> --}}
            @php
                $no = 1;
            @endphp
            @foreach ($survey as $srv)
                @php
                    $last_id = end($survey)['current']['id'];
                @endphp
                @if ($srv['current']['type'] == 'option')
                    <div class="swiper-slide">
                        <div class="container">
                            <h4 class="text-center mb-4">{{ $no . '. ' . $srv['current']['question'] }}</h4>
                            <div class="row justify-content-around align-items-center">
                                <div style="width: 70%" class="d-flex justify-content-center justify-content-sm-around">
                                    @foreach (Helper::option_array() as $key => $option)
                                        <label>
                                            <input type="radio"
                                                onclick="slide('{{ $last_id == $srv['next']['id'] ? 'last' : $srv['next']['type'] }}', )"
                                                name="survey_{{ $srv['current']['id'] }}" value="{{ $option }}"
                                                class="option-input radio">
                                            {{ $option }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="swiper-slide">
                        <div class="container">
                            <h4 class="text-center mb-4">{{ $no . '. ' . $srv['current']['question'] }}</h4>
                            <div class="row justify-content-around align-items-center">
                                <textarea name="survey_{{ $srv['current']['id'] }}" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                @endif
                @php
                    $no++;
                @endphp
            @endforeach


            {{-- <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">3. Saya suka merawat hewan</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio r" onclick="slide()"
                                    name="data-3" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio r" onclick="slide()"
                                    name="data-3" /></label>
                            <label> <input type="radio" value="1" class="option-input radio r" onclick="slide()"
                                    name="data-3" /></label>
                            <label> <input type="radio" value="2" class="option-input radio r" onclick="slide()"
                                    name="data-3" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">4. Saya suka menyatukan / merakit sesuatu</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio r" onclick="slide()"
                                    name="data-4" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio r" onclick="slide()"
                                    name="data-4" /></label>
                            <label> <input type="radio" value="1" class="option-input radio r" onclick="slide()"
                                    name="data-4" /></label>
                            <label> <input type="radio" value="2" class="option-input radio r" onclick="slide()"
                                    name="data-4" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">5. Saya suka memasak</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio r"
                                    onclick="slide()" name="data-5" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio r"
                                    onclick="slide()" name="data-5" /></label>
                            <label> <input type="radio" value="1" class="option-input radio r"
                                    onclick="slide()" name="data-5" /></label>
                            <label> <input type="radio" value="2" class="option-input radio r"
                                    onclick="slide()" name="data-5" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">6. Saya orang yang praktis</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio r"
                                    onclick="slide()" name="data-6" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio r"
                                    onclick="slide()" name="data-6" /></label>
                            <label> <input type="radio" value="1" class="option-input radio r"
                                    onclick="slide()" name="data-6" /></label>
                            <label> <input type="radio" value="2" class="option-input radio r"
                                    onclick="slide()" name="data-6" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">7. Saya suka bekerja di luar ruangan (outdoor)</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio r"
                                    onclick="slide()" name="data-7" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio r"
                                    onclick="slide()" name="data-7" /></label>
                            <label> <input type="radio" value="1" class="option-input radio r"
                                    onclick="slide()" name="data-7" /></label>
                            <label> <input type="radio" value="2" class="option-input radio r"
                                    onclick="slide()" name="data-7" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">8. Saya suka mengerjakan puzzle</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-8" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-8" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-8" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-8" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">9. Saya suka melakukan eksperimen / percobaan</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-9" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-9" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-9" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-9" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">10. Saya suka dengan sesuatu yang berhubungan dengan science</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-10" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-10" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-10" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-10" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">11. Saya suka bekerja dengan angka dan bagan (matematis)</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-11" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-11" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-11" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-11" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">12. Saya suka matematika</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-12" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-12" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-12" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-12" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">13. Saya orang yang disiplin</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-13" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-13" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-13" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-13" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">14. Saya suka menjabarkan sesuatu secara logis dan teratur</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio i"
                                    onclick="slide()" name="data-14" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio i"
                                    onclick="slide()" name="data-14" /></label>
                            <label> <input type="radio" value="1" class="option-input radio i"
                                    onclick="slide()" name="data-14" /></label>
                            <label> <input type="radio" value="2" class="option-input radio i"
                                    onclick="slide()" name="data-14" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">15. Saya menyukai videografi dan fotografi</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-15" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-15" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-15" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-15" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">16. Saya suka membaca tentang seni dan musik</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-16" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-16" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-16" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-16" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">17. Saya suka menulis (dengan kreatif)</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-17" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-17" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-17" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-17" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">18. Saya suka memainkan alat musik dan bernyanyi</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-18" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-18" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-18" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-18" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">19. Saya suka menggambar</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-19" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-19" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-19" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-19" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">20. Saya orang yang imajinatif</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-20" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-20" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-20" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-20" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">21. Saya lebih suka bekerja sendiri / mandiri
                    </h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio a"
                                    onclick="slide()" name="data-21" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio a"
                                    onclick="slide()" name="data-21" /></label>
                            <label> <input type="radio" value="1" class="option-input radio a"
                                    onclick="slide()" name="data-21" /></label>
                            <label> <input type="radio" value="2" class="option-input radio a"
                                    onclick="slide()" name="data-21" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">22. Saya suka bekerja dalam tim</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-22" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-22" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-22" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-22" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">23. Saya suka mengajar / melatih orang lain</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-23" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-23" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-23" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-23" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">24. Saya suka membantu orang memecahkan masalah mereka</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-24" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-24" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-24" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-24" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">25. Saya tertarik menyembuhkan orang</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-25" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-25" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-25" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-25" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">26. Saya senang belajar tentang budaya</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-26" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-26" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-26" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-26" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">27. Saya bersahabat dan mudah bergaul</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-27" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-27" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-27" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-27" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">28. Saya orang dengan rasa toleransi yang tinggi</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio s"
                                    onclick="slide()" name="data-28" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio s"
                                    onclick="slide()" name="data-28" /></label>
                            <label> <input type="radio" value="1" class="option-input radio s"
                                    onclick="slide()" name="data-28" /></label>
                            <label> <input type="radio" value="2" class="option-input radio s"
                                    onclick="slide()" name="data-28" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">29. Saya adalah orang yang ambisius</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-29" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-29" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-29" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-29" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">30. Saya suka mencoba membujuk dan mempengaruhi orang lain</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-30" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-30" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-30" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-30" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">31. Saya suka berjualan</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-31" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-31" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-31" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-31" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">32. Saya ingin memulai bisnis saya sendiri</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-32" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-32" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-32" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-32" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">33. Saya suka memimpin</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-33" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-33" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-33" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-33" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">34. Saya mudah beradaptasi</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-34" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-34" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-34" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-34" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">35. Saya suka mengambil resiko dan spontan</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio e"
                                    onclick="slide()" name="data-35" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio e"
                                    onclick="slide()" name="data-35" /></label>
                            <label> <input type="radio" value="1" class="option-input radio e"
                                    onclick="slide()" name="data-35" /></label>
                            <label> <input type="radio" value="2" class="option-input radio e"
                                    onclick="slide()" name="data-35" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">36. Saya suka mengatur sesuatu (file, meja, kantor)</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-36" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-36" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-36" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-36" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">37. Saya ingin mengikuti instruksi yang jelas untuk diikuti</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-37" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-37" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-37" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-37" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">38. Saya memperhatikan sesuatu yang detail</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-38" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-38" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-38" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-38" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">39. Saya ingin bekerja di kantor</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-39" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-39" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-39" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-39" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">40. Saya suka dengan kedisiplinan dan ketepatan</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-40" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-40" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-40" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-40" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">41. Saya tidak keberatan bekerja 8 jam sehari di kantor</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-41" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-41" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-41" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-41" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <h4 class="text-center mb-4">42. Saya suka mengetik</h4>
                    <div class="row justify-content-around align-items-center">
                        <p style="width: 20%" class="text-center">Tidak setuju</p>
                        <div style="width: 50%" class="d-flex justify-content-center justify-content-sm-around">
                            <label> <input type="radio" value="-2" class="option-input radio c"
                                    onclick="slide()" name="data-42" /></label>
                            <label> <input type="radio" value="-1" class="option-input radio c"
                                    onclick="slide()" name="data-42" /></label>
                            <label> <input type="radio" value="1" class="option-input radio c"
                                    onclick="slide()" name="data-42" /></label>
                            <label> <input type="radio" value="2" class="option-input radio c"
                                    onclick="slide()" name="data-42" /></label>
                        </div>
                        <p style="width: 20%" class="text-center">Sangat setuju</p>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="swiper-slide">
                <button class="btn btn-info" onclick="prior()">Lanjutkan</button>
            </div>

            <div class="swiper-slide">
                <form action="https://www.makinmahir.id/test-minat/save" method="GET" id="formRias">
                    <input type="hidden" name="_token" value="xmLMaqMD907C6mYM7JcP9Kc7Yvwj1E2PxNNek1l4"> <input
                        type="hidden" name="hasil" id="hasil">
                    <input type="hidden" name="prior" id="prior_form">
                </form>
                <div class="row justify-content-center">
                    <button class="btn btn-primary" onclick="hasils()">Kirim</button>
                </div>
            </div> --}}

        </div>

        {{-- <div class="swiper-pagination"> --}}
        <div class="swiper-container">
            <div class="btn mx-1 btn-sm btn-primary text-white swiper-btn-prev"><i class="fa-solid fa-arrow-left"></i>
                sebelumnya</div>
            <div class="btn mx-1 btn-sm btn-info text-white swiper-next" id="swiper-next"> Selanjutnya <i
                    class="fa-solid fa-arrow-right"></i></div>
            <div class="btn mx-1 btn-sm btn-success text-white swiper-finish" id="swiper-finish"><i
                    class="fa-solid fa-paper-plane"></i> Kirim </div>


            {{-- <button id="swiper-next" class="swiper-next">Click</button> --}}

        </div>

        <div class="swiper-pagination"></div>
        {{-- </div> --}}

        <div id="prior-section" class="" style="display: none; height:100vh">
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <h4 class="text-center">Urutkan sesuai kepribadian Anda</h4>
                <ul class="list-group" id="prior">
                    <li class="list-group-item" data-prior="r">1.Saya suka membuat dan membangun sesuatu</li>
                    <li class="list-group-item" data-prior="i">2.Saya suka mencari tau bagaimana suatu benda bekerja
                    </li>
                    <li class="list-group-item" data-prior="a">3.Saya orang yang kreatif</li>
                    <li class="list-group-item" data-prior="s">4.Saya sangat senang jika dapat membantu orang lain</li>
                    <li class="list-group-item" data-prior="e">5.Saya suka memimpin</li>
                    <li class="list-group-item" data-prior="c">6.Saya suka memperhatikan hal detail</li>
                </ul>
                <div class="py-3">
                    <button class="btn btn-info text-white mx-auto" onclick="slides()">Lanjutkan</button>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script> --}}

        <!-- Initialize -->
        <script>
            //tombol utk next
            let next = document.getElementById("swiper-next")


            var swiper = new Swiper(".mySwiper", {
                direction: 'horizontal',
                simulateTouch: true,
                mousewheel: true,
                freeMode: true,
                freeModeMomentum: true,
                freeModeSticky: true,
                cssMode: true,
                allowTouchMove: false,
                navigation: {
                    nextEl: ".swiper-next",
                    prevEl: ".swiper-btn-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    type: "progressbar",
                    type: "fraction",
                }
            });

            let swipers = document.getElementById('swipper');
            let priorSection = document.getElementById('prior-section');


            //masuk prior
            function prior() {
                swipers.style.display = "none";
                priorSection.style.display = "flex";
            }

            function slides() {

                swipers.style.display = "block";
                priorSection.style.display = "none";
                next.click();
            }

            var el = document.getElementById('prior');
            var sortable = Sortable.create(el);
        </script>


        <script>
            //slide when clicking 
            function slide(type) {
                if (type === 'option') {
                    $('.swiper-next').addClass("d-none");
                    $('.swiper-finish').addClass("d-none");
                } else if (type === 'last') {
                    $('.swiper-next').addClass("d-none");
                    $('.swiper-finish').removeClass("d-none");
                } else {
                    $('.swiper-next').removeClass("d-none");
                    $('.swiper-next').attr('onClick','stopMoving()');
                    $('.swiper-finish').addClass("d-none");
                }
                next.click();
            }

            let clas;
            let iteration = 0;
            let datas = ['r', 'i', 'a', 's', 'e', 'c'];
            let hasil = [0, 0, 0, 0, 0, 0];
            let priors_comp = document.getElementsByClassName('list-group-item');


            function cek(data) {
                clas = document.getElementsByClassName(data);
                for (var i of clas) {
                    if (i.checked) {
                        hasil[iteration] += parseInt(i.value);
                    }
                }
                iteration++;
            }

            function hasils() {

                //mengurutkan prioritas
                let priors = [];
                for (let y of priors_comp) {
                    priors.push(y.dataset.prior);
                }

                datas.forEach(data => {
                    cek(data);
                });

                document.getElementById('hasil').value = JSON.stringify(hasil);
                document.getElementById('prior_form').value = JSON.stringify(priors);
                document.getElementById('formRias').submit();
            }
        </script>

</body>


</html>
