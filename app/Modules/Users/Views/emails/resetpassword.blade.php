@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'loreal.com'])
            Lo'real
        @endcomponent
    @endslot

    {{-- Body --}}
    You are receiving this email because we received a password reset request for your account. tack this code  to reset your password:
    <!-- Body here -->

   @component('mail::button', ['url' => 'http://lorealtoolkit.bluecrunch.com/password/reset/'.$token])
       Reset Password
   @endcomponent
   
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
          Lo'real Medical  @ {{date('Y')}} , thanks
        @endcomponent
    @endslot
@endcomponent
