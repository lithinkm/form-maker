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
                                            {{ $form->name }}

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form class="w-full max-w-lg" method="post" action="{{ route('saveData') }}">
                                                    @csrf
                                                @if (isset($form->fields))
                                                @foreach ($form->fields as $item)
                                                <div class="flex mb-2">
                                                    <div class="form-group col-md-4">
                                                        <label class="flex items-center tracking-wide text-gray-700 text-base font-bold mb-2" >{{ $item->label }}
                                                        </label>
                                                        @if($item->type != 'select')

                                                        <input type="{{ $item->type }}" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="{{ $item->placeholder }}" maxlength="{{ $item->length }}">
                                                        @else
                                                       <?php $options = explode(',',$item->options->name);?>
                                                        <select name="type[]" id="type"
                                                        class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="">Choose one</option>
                                                        @if($options)
                                                        @foreach($options as $option)
                                                        <option>{{ $option }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>


                                                        @endif
                                                    </div>
                                                </div>

                                                @endforeach
                                                @endif
                                                <button class="bg-purple-500 hover:bg-purple-700 font-bold text-white py-2 px-4 rounded mr-3" type="submit">
                                                   Save Data
                                                </button>
                                            </form>

                                            </td>
                                        </tr>
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
