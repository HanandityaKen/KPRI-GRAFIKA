<!-- Footer -->
<footer class="bg-white text-green-700 py-10">
  <!-- Garis Pemisah -->
  <hr class="border-gray-300 my-6 mx-6" />
  <div class="container mx-auto px-6 md:px-20 flex flex-col md:flex-row justify-between items-start md:items-center space-y-6 md:space-y-0">
    <!-- Kiri: Logo dan Informasi -->
    <div class="flex items-start gap-4">
      <img src="{{ asset('storage/assets/logo_kpri.png') }}" alt="Logo KPRI Grafika" class="w-20 h-20 object-cover rounded-full flex-shrink-0" />
      <div>
        <h3 class="text-lg font-semibold">KPRI Grafika</h3>
        <p class="text-sm text-green-700 leading-relaxed">Jl. Tanimbar No.34, Kasin, Kec. Klojen, Kota Malang, Jawa Timur 6511</p>
        <a href="telp: 0341353735" class="text-sm text-green-700">0341-353735</a>
      </div>
    </div>

    <!-- Kanan: Google Maps -->
    <div class="text-center md:text-left">
      <h4 class="text-md text-sm font-semibold mb-2">Temukan Kami</h4>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.938948799078!2d112.621!3d-7.9789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTgnNDQuNyJTIDExMsKwMzcnMjYuMCJF!5e0!3m2!1sen!2sid!4v1700000000000"
        width="280"
        height="180"
        class="rounded-lg shadow-lg"
        style="border: 0"
        allowfullscreen=""
        loading="lazy"
      >
      </iframe>
    </div>
  </div>

  <!-- Copyright -->
  <p class="text-center text-xs text-gray-600">Copyright &copy; {{ date('Y') }}. All rights reserved.</p>
</footer>