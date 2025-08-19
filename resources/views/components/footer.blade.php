<footer id="contact">
    <div class="container">
        <div class="footer-container">
            <div class="footer-about">
                <h3 class="footer-title">Tentang Desa Trengguli</h3>
                <p>Desa Trengguli adalah desa yang terletak di kabupaten XXX, provinsi XXX. Dengan kekayaan alam dan budaya yang beragam, kami berkomitmen untuk membangun desa yang mandiri dan sejahtera.</p>
                <div class="footer-social">
                    @if($profile && $profile->facebook)
                        <a href="https://facebook.com/{{ $profile->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($profile && $profile->instagram)
                        <a href="https://instagram.com/{{ $profile->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($profile && $profile->youtube)
                        <a href="https://youtube.com/{{ $profile->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if($profile && $profile->whatsapp)
                        <a href="https://wa.me/62{{ ltrim($profile->whatsapp, '0') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    @endif
                </div>
            </div>
            <div class="footer-links">
                <h3 class="footer-title">Tautan Cepat</h3>
                <ul>
                    <li><a href="{{ url('/') }}#home">Beranda</a></li>
                    <li><a href="{{ url('/') }}#about">Profil Desa</a></li>
                    <li><a href="{{ url('/') }}#services">Layanan Digital</a></li>
                    <li><a href="{{ url('/') }}#news">Berita</a></li>
                    <li><a href="{{ url('/') }}#gallery">Galeri</a></li>
                    <li><a href="{{ url('/') }}#contact">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3 class="footer-title">Kontak Kami</h3>
                <ul>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $profile->address ?? 'Alamat belum tersedia' }}</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>{{ $profile->phone ?? 'Nomor telepon belum tersedia' }}</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>{{ $profile->email ?? 'Email belum tersedia' }}</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>{{ $profile->office_hours ?? 'Jam operasional belum tersedia' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>© {{ date('Y') }} {{ $profile->village_name ?? 'Desa Trengguli' }}. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</footer>