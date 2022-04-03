@extends('partials.web-nav')
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
                                                <a href="{{ route('viewForm', ['code' => $row->code]) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mrg delete-button mr-3"
                                                    data-placement="top" data-toggle="tooltip"
                                                    data-original-title="Edit">View</a>
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

@section('scripts')
@endsection
