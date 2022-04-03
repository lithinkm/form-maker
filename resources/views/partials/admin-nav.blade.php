<title>FormMaker</title>
<link href="{{ URL::asset('/css/app.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .tags-look .tagify__dropdown__item{
  display: inline-block;
  border-radius: 3px;
  padding: .3em .5em;
  border: 1px solid #CCC;
  background: #F3F3F3;
  margin: .2em;
  font-size: .85em;
  color: black;
  transition: 0s;
}

.tags-look .tagify__dropdown__item--active{
  color: black;
}

.tags-look .tagify__dropdown__item:hover{
  background: lightyellow;
  border-color: gold;
}
</style>
<div class="hidden lg:block pb-12 relative" v-if="$route.path == '/photos' || $route.path == '/photodetail'">
    <header class="relative lg:fixed w-full top-0 z-50 bg-white border border-gray-200" data-v-4eecb332>
    <div class="wrap flex items-center relative h-12 px-10" data-v-4eecb332>
        <div class="logo flex-shrink-0 w-8 no-underline relative text-xl tracking-wide font-bold" data-v-4eecb332>
        FormMaker
        </div>
        <div class="nav__top block absolute absolute-center" data-v-f3f2649c="">
        <ul class="my-0 pl-0 list-none flex items-center" data-v-f3f2649c="">
            <li data-v-f3f2649c="">
            <a href="{{ route('showForms') }}" data-v-f3f2649c="" class="inline-block text-base font-normal leading-snug no-underline text-gray-700 whitespace-no-wrap cursor-pointer">Forms</a>
            </li>
        </ul>
        </div>
        <ul class="nav__actions my-0 ml-auto list-none h-15 flex items-center">
        <a href="{{ route('logout') }}" class="bg-purple-100 hover:bg-purple-200 text-purple-500 font-bold mr-3 py-1 px-2 rounded-md inline-flex items-center w-full justify-center">
            <span>Logout</span>
        </a>
        <div class="flex items-center">
            <img
            class="w-10 h-10 inline-block rounded-full mr-4"
            src="{{ asset('assets/image/user.jpg') }}"
            alt="Shahas Nizar" />
    </div>
        </ul>
    </div>
    </header>
</div>

@yield('content')

@yield('scripts')
