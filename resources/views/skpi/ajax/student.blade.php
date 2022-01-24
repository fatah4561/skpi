@foreach ($students as $student)                          
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    
    <td>{{ $student->nrp }}</td>
    <td>{{ $student->name }}</td>
    <td>{{ $student->class }}</td>
    <td>{{ $student->major }}</td>
    <td>{{ $student->college_type }}</td>
    <td>{{ $student->user->email }}</td>
    <td>{{ $student->phone_number }}</td>
    <td>{{ $student->defence_status }}</td>
    <td><a class="btn btn-outline-primary" href="" id="edit" data-toggle="modal" 
        data-target="#tambah_pengumpulan" data-nrp="{{$student->nrp}}" 
        data-nama="{{$student->name}}" data-kelas="{{$student->class}}" 
        data-jurusan="{{$student->major}}" data-tipe="{{$student->college_type}}" 
        data-email="{{$student->user->email }}" data-no="{{$student->phone_number}}" 
        data-status="{{$student->defence_status}}"
            role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    </td>
</tr>
@endforeach