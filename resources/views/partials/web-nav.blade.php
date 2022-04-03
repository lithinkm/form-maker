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
    </div>
    </header>
</div>

@yield('content')

@yield('scripts')
