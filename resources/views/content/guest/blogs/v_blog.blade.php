@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        @include('package.fullcalendar.fullcalendar_css')
        <style>
            .container-fluid {
                z-index: 3;
            }

            .main-content {
                margin-top: -700px;
            }

            @media only screen and (max-width: 480px) {
                .container.p-5.bg-light {
                    margin-top: 85px !important;
                    width: auto !important;
                    margin: 0 10px;
                    padding: 10px !important;
                }

                .main-content {
                    margin-top: -880px !important;
                }
            }
        </style>
    @endpush
    <section class="hero-section" id="hero">

        <div class="wave">

            <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                        <path
                            d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z"
                            id="Path"></path>
                    </g>
                </g>
            </svg>

        </div>
    </section>
    <div class="container-fluid position-relative">
        <div class="main-content p-5 bg-transparent rounded" style="">
            <div class="bg-transparent">
                <div class="text-center">
                    <h2 class="mt-3 text-white">Agenda</h2>
                    <p class="mt-3 text-white">kegiatan yang masih dilakukan oleh para alumni guna mempererat tali
                        silahturahmi
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between my-2">
                                <h5 class="card-title my-auto">Blog Kami</h5>
                                <form class="row gy-2 gx-3 align-items-center">
                                    <div class="col-auto">
                                        <label class="visually-hidden" for="autoSizingInput">Name</label>
                                        <input type="text" class="form-control" id="autoSizingInput"
                                            placeholder="Cari disini">
                                    </div>
                                </form>
                            </div>
                            <hr>
                            @foreach ($blogs as $blog)
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4 my-auto">
                                            <img src="{{ $blog->file != null ? asset($blog->file) : asset('asset/img/no_image.jpeg') }}"
                                                class="img-fluid rounded-start">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $blog->title }}
                                                </h5>
                                                <p>{!! Str::limit($blog->content, 200) !!}</p>
                                                <hr class="mb-0">
                                            </div>
                                            <div class="card-body d-flex">
                                                @php
                                                    $img_profile = asset('asset/img/user4.jpg');
                                                    if ($blog->name_user) {
                                                        if ($blog->file_user) {
                                                            $img_profile = asset($blog->file_user);
                                                        }
                                                    } else {
                                                        if ($blog->file_admin) {
                                                            $img_profile = asset($blog->file_admin);
                                                        }
                                                    }
                                                @endphp
                                                <img alt="..." src="{{ $img_profile }}"
                                                    class="avatar avatar-sm rounded-circle me-2" height="50">
                                                <div class="d-flex align-items-start flex-column bd-highlight review">
                                                    <h6 class="my-0">
                                                        {{ $blog->name_user != null ? $blog->name_user : $blog->name_admin }}
                                                    </h6>
                                                    <p class="my-0">{{ DateHelper::timeHuman($blog->created_at) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                                {{ $blogs->links() }}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Kategori</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="" class="text-primary"><u>Semua Kategori</u></a>
                            </li>
                            @foreach ($categories as $category)
                                @if ($category['blogs_count'] != 0)
                                    <li class="list-group-item"><a href="" class="text-primary">
                                            <u>{{ $category['name'] }}</u></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        @include('package.fullcalendar.fullcalendar_js')
        <script>
            $(document).ready(function() {
                var SITEURL = "{{ url('/') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: SITEURL + "fullcalendar",
                    displayEventTime: true,
                    editable: true,
                    eventRender: function(event, element, view) {
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url: SITEURL + "fullcalendar/create",
                                data: 'title=' + title + '&start=' + start + '&end=' + end,
                                type: "POST",
                                success: function(data) {
                                    displayMessage("Added Successfully");
                                }
                            });
                            calendar.fullCalendar('renderEvent', {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                                true
                            );
                        }
                        calendar.fullCalendar('unselect');
                    },
                    eventDrop: function(event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + 'fullcalendar/update',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end +
                                '&id=' + event.id,
                            type: "POST",
                            success: function(response) {
                                displayMessage("Updated Successfully");
                            }
                        });
                    },
                    eventClick: function(event) {
                        var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + 'fullcalendar/delete',
                                data: "&id=" + event.id,
                                success: function(response) {
                                    if (parseInt(response) > 0) {
                                        $('#calendar').fullCalendar('removeEvents', event.id);
                                        displayMessage("Deleted Successfully");
                                    }
                                }
                            });
                        }
                    }
                });
            });

            function displayMessage(message) {
                $(".response").html("<div class='success'>" + message + "</div>");
                setInterval(function() {
                    $(".success").fadeOut();
                }, 1000);
            }
        </script>
    @endpush
@endsection
