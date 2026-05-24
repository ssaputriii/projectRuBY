<footer class="site-footer" id="kontak">
    <div class="container footer-grid">
        <section class="footer-about">
            <h2>Rumah BUMN Yogyakarta</h2>
            <p>
                Platform inkubasi dan pemberdayaan UMKM di Yogyakarta yang didukung oleh BUMN 
                untuk mengembangkan ekosistem wirausaha yang berkelanjutan.
            </p>
        </section>


        <section class="footer-contact">
            <h4>Kontak Kami</h4>
            <ul>
                <li>
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Lt. 2 Wisma BRI, Jl. Sagan Tim. No.123, Terban, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55223</span>
                </li>
                <li>
                    <i class="bi bi-telephone-fill"></i>
                    <span>085161609877</span>
                </li>
                <li>
                    <i class="bi bi-envelope-fill"></i>
                    <span>rumahbumnyogyakarta@gmail.com</span>
                </li>
                <li>
                    <i class="bi bi-instagram"></i>
                    <span>@rumahbumn.yogyakarta</span>
                </li>
                <li>
                    <i class="bi bi-tiktok"></i>
                    <span>@rumahbumn.jogja</span>
                </li>
            </ul>
        </section>
    </div>

    <div class="footer-bottom">
        <p>© 2026 Rumah BUMN Yogyakarta. All rights reserved.</p>
        <div class="mt-2">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none small opacity-50 hover-opacity-100">Admin Panel</a>
            @else
                <a href="{{ route('admin.login') }}" class="text-white text-decoration-none small opacity-50 hover-opacity-100">Admin</a>
            @endif
        </div>
    </div>
</footer>
