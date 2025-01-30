@extends('admin.layout.main')

@section('content')
    
<div>
  <hr class="my-8 border-t-[2px] border-green-800 opacity-20 mb-5" />

  <div class="mb-5">
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            Dashboard
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{ route('admin.anggota') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Anggota</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Anggota</h1>
  </div>

  <div class="mb-6 flex justify-end">
    <button
      type="button"
      class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center"
    >
      <i data-lucide="plus" class="mr-2"></i>
      Tambah Anggota
    </button>
  </div>

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
                      Email
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Telepon
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
          <tr>
              <td class="font-medium text-gray-900 whitespace-nowrap">1</td>
              <td>Sugeng Sumirah, SPd</td>
              <td>sumiran@gmail.com</td>
              <td>08342734234</td>
              <td>
                <a href="">
                    <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                      <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                      </svg>                      
                    </button>
                </a>
                <button 
                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                    </svg>                    
                </button>
                <form id="" action="" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
              </td>
          </tr>
          <tr>
              <td class="font-medium text-gray-900 whitespace-nowrap">2</td>
              <td>MSFT</td>
              <td>$340.54</td>
              <td>$2.56T</td>
              <td>
                <a href="">
                    <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                      <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                      </svg>                      
                    </button>
                </a>
                <button 
                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                    </svg>                    
                </button>
                <form id="" action="" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
              </td>
          </tr>
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
  </script>
@endpush