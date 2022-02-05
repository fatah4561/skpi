@foreach ($collections as $collection)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $collection->start_date }}</td>
        <td>{{ $collection->end_date }}</td>
        {{-- perbandingan tanggal --}}
        <td>{{ ($diff[$loop->index]->d >0)?"Overdue" : $diff[$loop->index] ->format('%d Hari %h Jam') }}</td>
        <td>{{ $collection->collection_type}}</td>
        <td>{{ $collection->academic_year }}</td>
        <td>{{ $collection->detail }}</td>
        <td class="text-center">
            <a class="btn btn-outline-primary" href="{{ route('skpi_data') }}" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a class="btn btn-outline-primary" href="" id="edit" data-toggle="modal" data-target="#tambah_pengumpulan"
                data-tahunA="{{substr($collection->academic_year, 0, 4)}}" data-tahunB="{{substr($collection->academic_year, 5, 7)}}"
                data-tanggalM="{{ date('Y-m-d\TH:i', strtotime($collection->start_date)) }}" 
                data-tanggalA="{{ date('Y-m-d\TH:i', strtotime($collection->end_date)) }}" 
                data-jenis="{{ $collection->collection_type }}" 
                data-ket="{{ $collection->detail }}" 
                data-id-pengumpulan="{{ $collection->id }}" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            @if ($has_fill[$loop->index] == false)
                <form action="{{route('collection_delete', ['collection_id'=>$collection->id])}}" method="POST">
                    @csrf
                    @method('post')
                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>

                </form>                                                              
            @endif
            
        </td>
    </tr>
@endforeach