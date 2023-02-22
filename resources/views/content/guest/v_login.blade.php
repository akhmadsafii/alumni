@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .container-fluid {
                z-index: 3;
            }

            .main-content {
                margin-top: -350px;
            }

            .hero-section,
            .hero-section>.container>.row {
                height: 65vh !important;
                min-height: 420px !important;
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center" style="min-height: 200px !important">
                            <i class="bi bi-x-circle text-danger" style="font-size:60px;"></i>
                            <h4>Akses ditolak!</h4>
                            <p class="mr-t-10 mb-0">Anda tidak memiliki izin mengakses Halaman ini.</p>
                            <p class="mt-0 mr-b-20">Untuk dapat mengakses. silahkan lakukan login terlebih dahulu.
                            </p>
                            <a href="{{ route('auth.login') }}" class="btn btn-primary btn-lg btn-rounded mr-b-20 mx-1 ripple"><i
                                    class="bi bi-box-arrow-in-right"></i> Login Aplikasi</a>
                        </div>
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
