<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="flex items-center">
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-1/2 rounded-md">
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <div class="min-w-[364px] mb-4 mt-4 px-2">
            <div class="mb-4 mt-4 px-4 flex justify-between">
                <h1 class="font-bold whitespace-nowrap">Sisa Hasil Usaha</h1>
                <h1 class="font-bold whitespace-nowrap ml-2">Rp {{ number_format($shu->jumlah_shu, 0, ',', '.') }}</h1>
            </div>       
            <div class="px-4 mb-4">
                <hr class="my-2 border-t-[1px] border-green-800 opacity-20">
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Jasa Simpanan</h2>
                    <h2 class="font-semibold whitespace-nowrap">(25%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($jasa_simpanan, 0, ',', '.') }}</h2>
                </div>
            </div> 
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Jasa Partisipasi</h2>
                    <h2 class="font-semibold whitespace-nowrap">(20%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($jasa_partisipasi, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Dana Pengurus</h2>
                    <h2 class="font-semibold whitespace-nowrap">(10%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($dana_pengurus, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Dana Karyawan</h2>
                    <h2 class="font-semibold whitespace-nowrap">(5%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($dana_karyawan, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Dana Pendidikan</h2>
                    <h2 class="font-semibold whitespace-nowrap">(5%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($dana_pendidikan, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Dana Sosial</h2>
                    <h2 class="font-semibold whitespace-nowrap">(5%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($dana_sosial, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold whitespace-nowrap">Cadangan</h2>
                    <h2 class="font-semibold whitespace-nowrap">(30%)</h2>
                </div>
                <div class="ml-2">
                    <h2 class="font-semibold whitespace-nowrap">Rp {{ number_format($cadangan, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="px-4 mb-4">
                <hr class="my-2 border-t-[1px] border-green-800 opacity-20">
            </div>
            <div class="mb-4 mt-4 px-4">
                <h1 class="font-bold whitespace-nowrap w-full text-right">
                    Rp {{ number_format($jasa_simpanan + $jasa_partisipasi + $dana_pengurus + $dana_karyawan + $dana_pendidikan + $dana_sosial + $cadangan, 0, ',', '.') }}
                </h1>
            </div>
        </div>
    </div>
</div>
