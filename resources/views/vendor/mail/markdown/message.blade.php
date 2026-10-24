@component('mail::layout')
    {{-- Header --}}
    @isset($header)
      @slot('header')
          @component('mail::header', ['url' => config('app.url')])
              {{ config('app.name') }}
          @endcomponent
      @endslot
    @endisset

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
@endcomponent
