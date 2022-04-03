<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket Plus">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <title>Form Maker</title>
    <link href="{{ URL::asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>




    <section class="h-screen relative w-full lg:justify-center mx-auto">
        <div class="items-container mx-auto w-full h-full">

            <div class="relative w-full lg:justify-center flex flex-no-wrap h-full">
                <div class="right-column-fixed sticky flex w-4/12 flex-col bg-purple-600 p-16 bg-cover"
                    style="background-image: url('assets/image/western-pattern.jpg')">
                    <div class="item-name">
                        <h1 class="header-big text-4xl leading-none font-extrabold text-white">Graphic Resources For Free
                            Download.</h1>
                    </div>
                </div>

                <div class="left-column flex flex-col w-9/12 p-24 bg-orange-100">
                    <div class="w-full max-w-md mx-auto">
                        <div class="auth-content">
                            <h2 class="text-2xl font-bold text-gray-800 mb-5">Sign In</h2>

                        </div>
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" role="form" method="post"
                            action="javascript:;" id="loginForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Username or Email Address
                                </label>
                                <input
                                    class="bg-gray-200 appearance-none border border-gray-200 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="inline-full-name" type="text" name="email" placeholder="you@yours.com">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                    Password
                                </label>
                                <input
                                    class="bg-gray-200 appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="password" type="password" name="password" placeholder="******************">
                            </div>

                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 shadow-md rounded-lg focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Sign In
                                </button>
                                <div class="msgDiv mg-t-20"></div>
                            </div>
                        </form>
                        <p class="text-center text-gray-500 text-xs">
                            &copy;2020. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script>
        $("#loginForm").validate({
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                errorClass: "dispError text-red-500 text-xs mt-1",
                errorElement: "p",
                email: {
                    required: 'Email is  required',
                    email: 'Email is invalid'
                },
                password: {
                    required: 'Password is required'
                }
            },
            submitHandler: function(form) {
                var form = document.getElementById('loginForm');
                var data = new FormData(form);
                $('.msgDiv').html(``);
                $.ajax({
                    type: "POST",
                    url: "{{ route('login') }}",
                    data: $(form).serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            window.location.href = "{{ route('dashboard') }}";
                        } else {
                            var html = "";
                            $.each(data.errors, function(key, value) {
                                html += value + "<br/>";
                            });
                            $('.msgDiv').html(` <div class="dispError">` + html + `</div> `);
                            $('.msgDiv').css("color", "red");
                            setTimeout(function() {
                                $('.msgDiv').html(``);
                            }, 6000);
                        }
                    }
                });
                return false;
            }
        });
    </script>
</body>

</html>
