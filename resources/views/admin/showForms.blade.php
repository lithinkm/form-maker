@extends('partials.admin-nav')
@section('content')
    <section class="eats-wrapper relative w-11/12 lg:justify-center mx-auto">
        @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <p style="color:red">{{ session()->get('message') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <p style="colot:red">{{ implode('', $errors->all(':message')) }}</p>
            </div>
        @endif
        <div class="items-container flex mx-auto mt-8 w-full">
            <div class="ui_single-container relative lg:justify-center flex flex-no-wrap w-1/3 mr-20">

                <form class="w-full max-w-lg" method="post" action="{{ route('saveForms') }}">
                    @csrf
                    <div class="w-full py-3">
                        <span class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2">
                            @if ($form)
                                Edit form
                            @else
                                Add New form{{ $form }}
                            @endif
                        </span>
                    </div>

                    <div class=" -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                for="grid-last-name" required>
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="title" name="name" type="text" placeholder="form title"
                                @if ($form) value="{{ $form->name }}" @endif>
                            <input type="hidden" name="id"
                                @if ($form) value="{{ $form->id }}" @endif>
                        </div>
                    </div>
                    <div class="-mx-3 mb-6">
                        <div class="w-full px-3">
                            <div id="personalised_fields" class="mb-3">
                                <div class="custom_field_err"></div>
                                <div class="field_wrapper">

                                    @if (isset($form->fields))
                                        @foreach ($form->fields as $item)
                                            <div class="personalised_fields-ad">
                                                <label
                                                    class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                                    for="grid-last-name" required>Personalised fields</label></p>
                                                <div class="flex mb-2">
                                                    <div class="form-group col-md-6">
                                                        <select name="type[]" id="type"
                                                            class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            onchange="changeType('textdiv','selectdiv','');">
                                                            <option value="">Select a type</option>
                                                            <option @if ($item->type == 'text') selected @endif
                                                                value="text">Text</option>
                                                            <option @if ($item->type == 'email') selected @endif
                                                                value="email">Email</option>
                                                            <option @if ($item->type == 'number') selected @endif
                                                                value="number">Number</option>
                                                            <option @if ($item->type == 'date') selected @endif
                                                                value="date">Date</option>
                                                            <option @if ($item->type == 'select') selected @endif
                                                                value="select">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="flex mb-2">
                                                    <div class="form-group col-md-4">
                                                        <input
                                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            type="text" name="display_name[]" value="{{ $item->label }}"
                                                            placeholder="Label Name" />
                                                    </div>
                                                </div>
                                                @if ($item->type != 'select')
                                                    <div id="textdiv">
                                                        <div class="flex mb-2">
                                                            <div class="form-group col-md-4">
                                                                <input
                                                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                                    type="text" name="placeholder[]"
                                                                    value="{{ $item->placeholder }}"
                                                                    placeholder="Place Holder" id="placeholder" />
                                                            </div>
                                                        </div>
                                                        <div class="flex mb-2">
                                                            <div class="form-group col-md-4 mb-0">
                                                                <input
                                                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                                    type="text" name="length[]"
                                                                    value="{{ $item->length }}" placeholder="Length"
                                                                    id="length" />
                                                                <input type="hidden" name="option[]" value=""
                                                                    placeholder="Option" id="Option" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div id="selectdiv">
                                                        <label
                                                            class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-1"
                                                            for="grid-last-name" required>Add options(Comma
                                                            saparated)</label>
                                                        </p>
                                                        <div class="flex mb-1">
                                                            <div class="form-group col-md-4">
                                                                <input
                                                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                                    type="text" name="option[]"
                                                                    value="{{ $item->options->name }}"
                                                                    placeholder="Option" id="Option" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        @endforeach
                                    @else
                                        <div class="personalised_fields-ad">
                                            <label
                                                class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2"
                                                for="grid-last-name" required>Personalised fields</label></p>
                                            <div class="flex mb-2">
                                                <div class="form-group col-md-6">
                                                    <select name="type[]" id="type"
                                                        class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                        onchange="changeType('textdiv','selectdiv','');">
                                                        <option value="">Select a type</option>
                                                        <option value="text">Text</option>
                                                        <option value="email">Email</option>
                                                        <option value="number">Number</option>
                                                        <option value="date">Date</option>
                                                        <option value="select">Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex mb-2">
                                                <div class="form-group col-md-4">
                                                    <input
                                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                        type="text" name="display_name[]" value=""
                                                        placeholder="Label Name" />
                                                </div>
                                            </div>
                                            <div id="textdiv">
                                                <div class="flex mb-2">
                                                    <div class="form-group col-md-4">
                                                        <input
                                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            type="text" name="placeholder[]" value=""
                                                            placeholder="Place Holder" id="placeholder" />
                                                    </div>
                                                </div>
                                                <div class="flex mb-2">
                                                    <div class="form-group col-md-4 mb-0">
                                                        <input
                                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            type="text" name="length[]" value="" placeholder="Length"
                                                            id="length" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="selectdiv" style="display: none;">
                                                <label
                                                    class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-1"
                                                    for="grid-last-name" required>Add options(Comma saparated)</label>
                                                </p>
                                                <div class="flex mb-1">
                                                    <div class="form-group col-md-4">
                                                        <input
                                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            type="text" name="option[]" value="" placeholder="Option"
                                                            id="Option" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                                <a href="javascript:void(0);" class="add_button" title="Add field">Add more
                                    fields <img src="{{ asset('assets/image/add-icon.png') }}" /></a>
                            </div>
                        </div>
                    </div>

                    <button class="bg-purple-500 hover:bg-purple-700 font-bold text-white py-2 px-4 rounded mr-3">
                        @if ($form)
                            Edit form
                        @else
                            Create New form{{ $form }}
                        @endif
                    </button>
                </form>

            </div>


            <div class="flex flex-col flex-1">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-6">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($forms as $row)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $loop->iteration }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" data-title="">
                                                <div class="text-sm text-gray-900">{{ $row->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('showForms', ['id' => $row->id]) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mrg delete-button mr-3"
                                                    data-placement="top" data-toggle="tooltip"
                                                    data-original-title="Edit">Edit
                                                    <a href="{{ route('deleteForms', ['id' => $row->id]) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 mrg delete-button"
                                                        data-id="{{ $row->id }}" data-placement="top"
                                                        data-toggle="tooltip" data-original-title="Delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (!count($forms))
                                        <tr>
                                            <td colspan="5">No records found!</td>
                                        </tr>
                                    @endif

                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var x = 1; //Initial field counter is 1
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    function addInput() {

        if (x < maxField) {
            var fieldHTML =
                '<div class="personalised_fields-ad"><label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2" for="grid-last-name" required>Personalised fields</label></p> <div class="flex mb-2"> <div class="form-group col-md-6"> <select name="type[]" id="type' +
                x +
                '" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onchange=changeType("textdiv' +
                x + '","selectdiv' + x + '","' + x +
                '")> <option value="text">Text</option> <option value="email">Email</option><option value="mobile">Number</option> <option value="date">Date</option> <option value="select">Select</option> </select> </div> </div> <div class="flex mb-2"> <div class="form-group col-md-4"> <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="display_name[]" value="" placeholder="Label Name" />  </div> </div> <div id="textdiv' +
                x +
                '"> <div class="flex mb-2"> <div class="form-group col-md-4"> <input  class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" name="placeholder[]" value="" placeholder="Place Holder" id="placeholder"/> </div> </div> <div class="flex mb-2"> <div class="form-group col-md-4 mb-0"><input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="length[]" value=""placeholder="Length" id="length" /></div></div></div><div id="selectdiv' +
                x +
                '" style="display: none;"><labelclass="flex items-center tracking-wide text-gray-700 text-base font-bold mb-1" for="grid-last-name" required>Add options(Comma saparated)</label></p><div class="flex mb-1"><div class="form-group col-md-4"><input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="option[]" value="" placeholder="Option" id="Option"/></div></div></div></div>'; //New input field html
            x++; //Increment field counter
            $('.field_wrapper').append(fieldHTML); //Add field html
        } else {
            alert('You have reached maximum limit of 10 fields.')
            return false;
        }
    }

    function changeType(text, select, value) {
        var selectId = 'type' + value;
        var value = $("#" + selectId).val();
        if (value == 'select') {
            $('#' + text).hide();
            $('#' + select).show();
        } else {
            $('#' + select).hide();
            $('#' + text).show();
        }
    }
    $(document).ready(function() {
        $(".add_button").on('click', addInput);
    });

    function customValidation() {
        var display_name_err = false;
        var field_name_err = false;
        var upload_doc = false;
        var custom_arr = [];
        var file_arr = [];
        $('body').find('input[name="display_name[]"]').each(function() {
            if ($(this).val() == '') {
                display_name_err = true;
                $(this).css('border-color', 'red');
            }
        })

        $('body').find('input[name="field_name[]"]').each(function() {
            if ($(this).val() == '') {
                field_name_err = true;
                $(this).css('border-color', 'red');
            }
        });

        $('body').find('input[name="field_length[]"]').each(function() {
            if ($(this).val() == '') {
                $(this).val(100);
            }
        });

        if ($('#upload_doc').val() == '') {
            upload_doc = true;
        }

        if (display_name_err == true) {
            custom_arr.push("Please enter display name!<br>");
        }

        if (field_name_err == true) {
            custom_arr.push("Please enter field name!<br>");
        }
        if (upload_doc == true) {
            file_arr.push("Please upload file!<br>");
        }
        if (custom_arr.length == 0 && file_arr.length == 0) {
            $('.custom_field_err').html('');
            return true;
        } else {
            $('.custom_field_err').html('');
            $('.custom_file_err').html('');
            $.each(custom_arr, function(index, value) {
                $('.custom_field_err').append(value);
            });
            $.each(file_arr, function(index, value) {
                $('.custom_file_err').append(value);
            });

            return false;
        }
    }
</script>
@section('scripts')
@endsection
