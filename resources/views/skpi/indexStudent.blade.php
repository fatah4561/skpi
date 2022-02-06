@extends('layouts.custom')
    @section('content')
    {{-- alert belum ada cek nu orina --}}
        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-4">

                <!-- card data profile -->
                <div class="card h-100">
                    
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-uppercase mb-1" style="color:blue;">Data Pribadi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        <div class="mt-2 mb-0 text-muted text-s">Periksa data pribadi anda sebelum mengisi data SKPI </div>
                                    </div>
                                <div class="col-auto">
                                    <i class="fas fa-id-card fa-3x text-primary"></i>
                                </div>
                            </div>
                            <a  href="{{route('profile')}}" class="stretched-link" ></a>
                        </div>
                        
                    
                </div>
                </div>

                <!-- card data skripsi -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-s font-weight-bold text-uppercase mb-1" style="color:green;">Isi Data SKPI</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    <div class="mt-2 mb-0 text-muted text-s">
                                        {{ 'Klik Disini untuk mengisi data SKPI' }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-certificate fa-3x text-success"></i>
                                </div>
                            </div>
                            <a  href="{{route('fill_form')}}" class="stretched-link" ></a>
                        </div>
                    </div>
                </div>

        <!-- aktifitas terbaru -->
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="headings d-flex justify-content-between align-items-center mb-3">
                        <h5>Berita Pengumpulan Berkas</h5>
                        <div class="buttons"> <span class="badge bg-white d-flex flex-row align-items-center"> </span> </div>
                    </div>
                        {{-- looping kartu pengumpulan --}}
                        @foreach ($collections as $collection) 
                            <div class="card p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user d-flex flex-row align-items-center">
                                        <i class="fas fa-archive fa-lg user-img rounded-circle mr-2 text-primary" width="30"></i> 
                                        <span>
                                            <small class="font-weight-bold text-primary">Pengumpulan Berkas</small> 
                                            <small class="font-weight-bold">{{ $collection->start_date }}</small>
                                        </span> 
                                    </div> 
                                        <small>
                                            {{-- menampilkan deadline, can bner ie --}}
                                            @foreach ($deadlines as $deadline)
                                                @if ($deadline > $today)
                                                    {{ 'Overdue' }}
                                                @else
                                                    {{ $deadline->format('%d Hari %h Jam Tersisa') }}
                                                @endif
                                            @endforeach
                                        </small>
                                </div>
                                <div class="action d-flex justify-content-between mt-2 align-items-center">
                                    <div class="reply px-4"> <small>kategori mahasiswa: {{ $collection->collection_type }}</small> </div>
                                    <div class="icons align-items-center"> <i class="fas fa-newspaper text-primary"></i> </div>
                                </div>
                            </div>
                                </br>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
                
    @endsection
