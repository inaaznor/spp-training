<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Fail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header bg-primary text-white">SENARAI ANGGOTA PERKHIDMATAN PENDIDIKAN</div>
                        <div class="card-body">
                            <div class="mb-3 text-right">
                                <a href="{{ route('anggota-perkhidmatan.eksport') }}" class="btn btn-warning">Eksport</a>
                                <a href="{{ route('anggota-perkhidmatan.create') }}" class="btn btn-primary">Daftar</a>
                            </div>
                            <table class="table" id="listing-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NoKp</th>
                                        <th>No Fail</th>
                                        <th>No Fail Lain</th>
                                        <th>Tarikh Buka</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($app as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ strtoupper($value->name) }}</td>
                                            <td>{{ $value->nokp }}</td>
                                            <td>{{ strtoupper($value->new_file_no) }}</td>
                                            <td>{{ strtoupper($value->other_file_no) }}</td>
                                            <!-- <td>{{ $value->file_date }}</td> -->
                                            <td>{{ Carbon\Carbon::parse($value->file_date)->format('d-M-y') }}</td> <!--tukar formatting date drpd yyyy-mm-dd kpd d/m/y-->
                                            <td>
                                                <!-- <a class='btn btn-info btn-xs' href="{{ route('anggota-perkhidmatan.edit', $value->id) }}"><i class="fas fa-edit"></i> Kemaskini</a>  -->
                                                <a class='btn btn-info btn-xs' href="{{ route('anggota-perkhidmatan.edit', $value->id) }}"><i class="fas fa-edit"></i></a>
                                                <!-- <a href="{{ route('anggota-perkhidmatan.destroy', $value->id) }}" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i> Hapus</a> -->
                                                <form action="{{ route('anggota-perkhidmatan.destroy', $value->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <!-- <i class="fas fa-trash-alt"></i> Hapus -->
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>Teacher</td>
                                        <td>
                                            <a class='btn btn-info btn-xs' href="#"><i class="fas fa-edit"></i> Kemaskini</a> 
                                            <a href="#" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane Smith</td>
                                        <td>Principal</td>
                                        <td>
                                            <a class='btn btn-info btn-xs' href="#"><i class="fas fa-edit"></i> Kemaskini</a> 
                                            <a href="#" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr> -->

                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Initialize datepicker
            //$('#listing-table').DataTable(); //filter
            $('#listing-table').DataTable(
                {
                    "columnDefs": [
                        { "orderable": false, "targets": [5, 6] }
                    ]
                }
            );
        });
    </script>
    

</x-app-layout>