<nav class="bg-gradient-to-b from-hijau-tua to-hijau-muda fixed w-full z-40 top-0">
    <div class="flex justify-between px-4 py-1 items-center">
        <div class="container flex items-center">
            <div class="mr-5">
                <a href="/">
                    <img src="{{ asset('img/cmay_logo.png') }}" alt="Logo" class="w-20 h-20">
                </a>
            </div>
            <ul class="flex ml-3 space-x-8"> 
                <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
                <x-nav-link href="/menu" :active="request()->is('menu')">Menu</x-nav-link>
                <x-nav-link-contact href="/about" :active="request()->is('about')">Tentang C'may</x-nav-link>
                <x-nav-link-contact href="/contact-us" :active="request()->is('contact-us')">Hubungi Kami</x-nav-link-contact>  
            </ul>
        </div>

        <!-- Kondisi login -->
        @if(Auth::check())
        
        <div class="flex items-center justify-between px-3">
            <a href="/cart" class="flex items-center justify-center mr-3">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-1">
                    <img src="{{ asset('img/shopping-cart (1).png') }}" 
                        alt="Cart" 
                        class="w-full h-full object-cover">
                </div>
                <div class="text-kuning-keruh mr-2">Keranjang(<span id="count-cart">0</span>)</div>
            </a>
            
            <!-- Dropdown Akun -->
            <div class="relative">
                <button class="flex" id="account">
                    @if (Auth::user()->profile_picture)
                        @if (Auth::user()->membership)
                            <div class="w-14 h-14 rounded-full overflow-hidden border-[3px] border-kuning-keruh">
                                <img src="{{ asset('profile_picture/' . Auth::user()->profile_picture) }}" 
                                    alt="User Avatar" 
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-full overflow-hidden">
                                <img src="{{ asset('profile_picture/' . Auth::user()->profile_picture) }}" 
                                    alt="User Avatar" 
                                    class="w-full h-full object-cover">
                            </div>
                        @endif
                    @else
                        @if (Auth::user()->membership)
                            <div class="w-14 h-14 rounded-full overflow-hidden border-[3px] border-kuning-keruh">
                                <img src="{{ asset('img/profile.png') }}" 
                                    alt="User Avatar" 
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-full overflow-hidden">
                                <img src="{{ asset('img/profile.png') }}" 
                                    alt="User Avatar" 
                                    class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                    @endif
                </button>
               
                
                <div id="accountDropdown" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-md shadow-lg py-2 z-50">
                    @if (Auth::user()->membership)
                        <div class="flex justify-between py-2 px-4">
                            <div class="text-gray-700 font-bold">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="">
                                <h3 class="w-20 h-7 py-1 bg-gradient-to-r from-kuning-muda to-kuning-keruh text-center text-pink-keruh text-sm font-bold">Anggota</h3>
                            </div>
                        </div>    
                    @else
                        <div class="text-gray-700 font-bold py-2 px-4">
                            {{ Auth::user()->name }}
                        </div>
                    @endif
                    <hr class="my-2">
                    <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                    <a href="/order/history" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Riwayat Pemesanan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">Keluar</button>
                    </form>
                </div>      
            </div>
            {{-- <img src="{{ asset('img/pngegg (2).png') }}" alt="Dropdown Icon" class="w-16 h-7 ml-2">               --}}
        </div>
        @else
            <div class="px-3">
                <a href="/login" class="text-white text-sm rounded-lg font-bold flex items-center justify-center w-20 h-7 bg-gradient-to-b from-gray-800 to-gray-800 hover:bg-gradient-to-r hover:from-hijau-tua hover:to-pink-keruh">MASUK</a>
            </div>
        @endif
    </div>
</nav>

<script>
    // Script untuk toggle dropdown
    document.getElementById('account').addEventListener('click', function() {
        var dropdown = document.getElementById('accountDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Menutup dropdown saat klik di luar
    window.addEventListener('click', function(e) {
        if (!document.getElementById('account').contains(e.target)) {
            document.getElementById('accountDropdown').classList.add('hidden');
        }
    });
</script>
