@extends('layouts.main')

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <h1 style="margin-left: 10%">Product Information</h1>

    <div class="container" style="margin-top: 5%">
        <div class="row">
            <div class="col-md-5">
                <div class="book-pic">
{{--                    {{ dd($product) }}--}}
{{--                    <img src="{{ $books->image_url == null ? url('images/nobookcover.jpg') : url('images').'/'.$books->image_url }}" alt="" width="350">--}}
                    <img src="{{$product->picture == null ? url('images/nobookcover.png') : url('images').'/'.$product->picture}}"  style="border: 3px solid #ddd;" width="350">
                </div>
            </div>
            <div class="col-md-7">
                <p class="detail-title">Product Name</p>
                <h2 class="details-info" style=""> <strong>{{$product->product_name}}</strong> </h2>
                <p class="detail-title">Details</p>
                <h6 class="details-info">{{$product->details}}</h6>
                <p class="detail-title">Customer</p>
                <h6 class="details-info">{{$product->customer}}</h6>
                <br>

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Create Process
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create a Process</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('process.store', $product->id)}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="process_name" class="form-control" id="exampleFormControlInput1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid mt-3">
            <div class="card card-body">
                <canvas id="myChart" ></canvas>
            </div>
        </div>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Progress',
                        data: [],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                    }]
                },
                options: {
                    scales: {
                        xAxes: [],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var updateChart = function() {


                $.ajax({
                    url: "{{ route('process.index', $product->id) }}",
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);
                        var process = new Array ("Print", "Cut Paper", "Heat Press", "Cut Print", "Edging", "Piping Side", "Piping Strap", "Locking Strap", "Cutting Strap", "Pic & Pack");
                        var progress = [10, 10, 10, 10, 10, 9, 9, 5, 4, 2];
                        console.log(data);
                        myChart.data.labels = process;
                        myChart.data.datasets[0].data = data;

                        myChart.update();
                    },
                    error: function(data){
                        // console.log(data);
                    }
                });
            }

            updateChart();
            setInterval(() => {
                updateChart();
            }, 1000);


            $(document).on('click', '.editModalShow', function () {
                var id = $(this).attr('id');
                var route = "http://127.0.0.1:8000/api/customers/"+id;
                var updateRoute = "http://127.0.0.1:8000/customers/"+id;
                $('#editForm').attr('action', updateRoute);

                $.ajax({
                    url: route,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#first_name').val(data.customer.first_name);
                        $('#last_name').val(data.customer.last_name);
                        $('#fb_name').val(data.customer.fb_name);
                        $('#phone_number').val(data.customer.phone_number);
                        $('#company_name').val(data.customer.company_name);
                        $('#province').val(data.customer.province);
                        $('#town').val(data.customer.town);
                        $('#barangay').val(data.customer.barangay);
                        $('#location_details').val(data.customer.location_details);
                        $('#editAction').action('haaaaaaaaaaa');
                        console.log(data.customer.first_name);
                    },
                });
            });


        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
{{--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>--}}
    </div>

@endsection