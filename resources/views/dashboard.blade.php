<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header bg-primary text-white">CARIAN</div>
                        <div class="card-body">
                            <form action="{{ route('dashboard') }}" method="GET">
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Jantina:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">Sila Pilih Jantina</option>
                                            <!-- <option value="L">Lelaki</option>
                                            <option value="P">Perempuan</option> -->
                                            <option value="L" {{ request()->query('gender') == 'L' ? 'selected' : '' }}>Lelaki</option>
                                            <option value="P" {{ request()->query('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Tarikh:</label>
                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" id="date" name="date" placeholder="Sila Pilih Tarikh"> -->
                                        <input type="text" class="form-control" id="date" name="date" value="{{ request()->query('date') }}" placeholder="Sila Pilih Tarikh">
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="form-group text-center">
                                        <a href="{{ route('dashboard') }}" type="button" class="btn btn-warning">Reset</a>
                                        <button type="submit" class="btn btn-secondary">Hantar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="mybarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            var data = {!! json_encode($data) !!};
            var label = {!! json_encode($label) !!};

            // var label = <?php //echo json_encode($label); ?>;
            // var data = <?php //echo json_encode($data); ?>;

            var ctx = document.getElementById("mybarChart").getContext("2d");

            var mybarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah',
                        backgroundColor: "#000080",
                        data: data
                    }]
                },
                options: {
                    legend: {
                        display: false, // Hide the legend
                    },
                    title: {
                        display: true,
                        text: "Graf mengikut jawatan"
                    },
                }
            });

            $('#date').datepicker({
                format: 'yyyy-mm-dd', // Adjust the date format as needed
                autoclose: true
            });     
        });
    </script>
</x-app-layout>