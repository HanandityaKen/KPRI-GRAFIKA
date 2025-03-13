@extends('admin.layout.main')

@section('title', 'Dashboard')

@section('content')
<div>
  <hr class="my-2 border-t-[2px] border-green-800 opacity-20" />

  <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

  <!-- Dashboard Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-[#003705] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="users" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">{{ $jumlahAnggota }}</p>
        <h3 class="text-white mb-2">Anggota Aktif</h3>
      </div>
    </div>
    <div class="bg-gradient-to-br from-[#2E6A27] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="wallet" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
        <h3 class="text-white mb-2">Total Simpanan</h3>
      </div>
    </div>
    <div class="bg-gradient-to-br from-[#6DA854] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="credit-card" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
        <h3 class="text-white mb-2">Total Saldo Koperasi</h3>
      </div>
    </div>
  </div>

  <h1 class="text-xl font-bold mb-6">Tabel Anggota</h1>

  <!-- Anggota Table -->
  {{-- <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="p-3 text-left text-[#6DA854]">
            <div class="flex items-center">No</div>
          </th>
          <th class="p-3 text-left">
            <div class="flex items-center">
              Nama
              <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
            </div>
          </th>
          <th class="p-3 text-left">
            <div class="flex items-center">
              Telepon
              <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
            </div>
          </th>
          <th class="p-3 text-left">
            <div class="flex items-center">
              Username
              <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
            </div>
          </th>
          <th class="p-3 text-left">
            <div class="flex items-center">
              Email
              <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
            </div>
          </th>
          <th class="p-3 text-left">
            <div class="flex items-center">
              Password
              <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
            </div>
          </th>
          <th class="p-3 text-left">
            <div class="flex items-center">Action</div>
          </th>
        </tr>
      </thead>
      <tbody id="anggotaTableBody">
        <!-- Data akan diisi oleh JavaScript -->
      </tbody>
    </table>
  </div> --}}

  <div>
    <table id="search-table">
      <thead>
          <tr>
              <th>
                  <span class="flex items-center text-[#6DA854]">
                      No
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Nama
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Telepon
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Email
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Action
                  </span>
              </th>
          </tr>
      </thead>
      <tbody>
        @forelse ($users as $index => $user) 
          <tr>
              <td class="font-medium text-gray-900 whitespace-nowrap">{{$index + 1}}</td>
              <td>{{$user->nama}}</td>
              <td>{{$user->telepon}}</td>
              <td>{{$user->email}}</td>
              <td>
                <a href="{{ route('admin.anggota.edit', $user->id) }}">
                    <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                      Edit
                    </button>
                </a>
                <button 
                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                    onclick="confirmDelete({{ $user->id }})">
                      Hapus                  
                </button>
                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.anggota.destroy', $user->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
              </td>
          </tr>
          @empty
                        
          @endforelse
        </tbody>
    </table>
  </div>

    
  </div>
@endsection

@push('scripts')
<script>
  if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
      const dataTable = new simpleDatatables.DataTable("#search-table", {
          searchable: true,
          sortable: false
      });
  }

  // const sampleData = [
  //   {
  //     nama: "Sugeng Sumiran, SPd",
  //     telepon: "08342734234",
  //     email: "sumiran@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Sri Rahayuningsih, SPd",
  //     telepon: "08342734234",
  //     email: "sri@gmailcom",
  //     password: "********",
  //   },
  //   {
  //     nama: "Dra. Sri Untari, MM",
  //     telepon: "08342734234",
  //     email: "untari@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Dra. Umi Lestari",
  //     telepon: "08342734234",
  //     email: "lestari@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Edy Sugeng Priyono, SIP",
  //     telepon: "08342734234",
  //     email: "sugeng@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Drs. Eko Dewa Sukayanto",
  //     telepon: "08342734234",
  //     email: "eko@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Esti Sukorini Rahayu, BA",
  //     telepon: "08342734234",
  //     email: "esti@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Dra. Kun Fajarsari",
  //     telepon: "08342734234",
  //     email: "kun@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "M. Lahmudi, S.Pd",
  //     telepon: "08342734234",
  //     email: "lahmudi@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Eko Budi Iswanto, S.Pd",
  //     telepon: "08342734234",
  //     email: "budi@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Eru Martyanto, S.Pd",
  //     telepon: "08342734234",
  //     email: "eru@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Wageyanto, M.Pd",
  //     telepon: "08342734234",
  //     email: "wageyanto@gamil.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Rini Soesilowati, S.Pd",
  //     telepon: "08342734234",
  //     email: "rini@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Sumarah",
  //     telepon: "08342734234",
  //     email: "sumarah@gmail.com",
  //     password: "********",
  //   },
  //   {
  //     nama: "Titie Swasti, M.Pd",
  //     telepon: "08342734234",
  //     email: "titie@gmail.com",
  //     password: "********",
  //   },
  // ];
  // const tableBody = document.getElementById("anggotaTableBody");

  // sampleData.forEach((data, index) => {
  //   const row = document.createElement("tr");
  //   row.className = "border-b border-[#6DA854]";

  //   row.innerHTML = `
  //     <td class="p-3 text-[#6DA854]">${index + 1}</td>
  //     <td class="p-3">${data.nama}</td>
  //     <td class="p-3">${data.telepon}</td>
  //     <td class="p-3">${data.username}</td>
  //     <td class="p-3">${data.email}</td>
  //     <td class="p-3">${data.password}</td>
  //     <td class="p-3 flex">
  //       <button class="mr-2 text-white flex items-center bg-[#2E6A27] p-2 rounded-md">
  //         <i data-lucide="edit-2" class="mr-1"></i>
  //         Edit
  //       </button>
  //       <button class="text-white flex items-center bg-[#E04A4A] p-2 rounded-md">
  //         <i data-lucide="trash-2" class="mr-1"></i>
  //         Delete
  //       </button>
  //     </td>
  //   `;

  //   tableBody.appendChild(row);
  // });

  // lucide.createIcons();
  
  

</script>
@endpush