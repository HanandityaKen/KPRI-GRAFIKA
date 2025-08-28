<div>
    <div class="mb-8 flex justify-between items-center">
        <div class="relative w-2/3 sm:w-1/3">
            <div class="flex items-center">
                <select id="yearFilter" wire:model.change="selectedYear" class="p-2 bg-white border-2 border-[#6DA854] w-full rounded-md">
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto no-scrollbar">
        <div class="mb-4 mt-4 px-2">
            <div class="mb-4 mt-4 px-4 flex justify-between items-center">
                <h1 class="font-bold">Sisa Hasil Usaha</h1>
                <h1 class="font-bold">Rp {{ number_format($shu->jumlah_shu, 0, ',', '.') }}</h1>
            </div>       
            <div class="px-4 mb-4">
                <hr class="my-2 border-t-[1px] border-green-800 opacity-20">
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Jasa Simpanan</h2>
                    <h2 class="font-semibold">(25%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($jasa_simpanan, 0, ',', '.') }}</h2>
            </div> 
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Jasa Partisipasi</h2>
                    <h2 class="font-semibold">(20%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($jasa_partisipasi, 0, ',', '.') }}</h2>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Dana Pengurus</h2>
                    <h2 class="font-semibold">(10%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($dana_pengurus, 0, ',', '.') }}</h2>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Dana Karyawan</h2>
                    <h2 class="font-semibold">(5%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($dana_karyawan, 0, ',', '.') }}</h2>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Dana Pendidikan</h2>
                    <h2 class="font-semibold">(5%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($dana_pendidikan, 0, ',', '.') }}</h2>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Dana Sosial</h2>
                    <h2 class="font-semibold">(5%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($dana_sosial, 0, ',', '.') }}</h2>
            </div>
            <div class="mb-4 px-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <h2 class="font-semibold">Cadangan</h2>
                    <h2 class="font-semibold">(30%)</h2>
                </div>
                <h2 class="font-semibold">Rp {{ number_format($cadangan, 0, ',', '.') }}</h2>
            </div>
            <div class="px-4 mb-4">
                <hr class="my-2 border-t-[1px] border-green-800 opacity-20">
            </div>
            <div class="mb-4 mt-4 px-4">
                <h1 class="font-bold w-full text-right">
                    Rp {{ number_format($jasa_simpanan + $jasa_partisipasi + $dana_pengurus + $dana_karyawan + $dana_pendidikan + $dana_sosial + $cadangan, 0, ',', '.') }}
                </h1>
            </div>
        </div>
    </div>
</div>
