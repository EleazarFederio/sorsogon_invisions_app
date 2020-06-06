@extends('layouts.main')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <div class="container" style="margin-top: 5%; margin-left: 30px">
        <div class="row">
            <div class="col-md-6">
                <h2 class="details-info" style=""> <strong>{{$customer->first_name}} {{$customer->last_name}}</strong> </h2>
                <p class="detail-title">Address</p>
                <h6 class="details-info">{{$customer->barangay}}, {{$customer->town}}, {{$customer->province}}</h6>
                <p class="detail-title">Phone Number</p>
                <h6 class="details-info">{{$customer->phone_number}}</h6>
            </div>
            <div class="col-md-6">
                <h2 class="details-info"></h2>
                <p class="detail-title">Company</p>
                <h6 class="details-info">{{$customer->company_name}}</h6>
                <p class="detail-title">Location Details</p>
                <h6 class="details-info">{{$customer->location_details}}</h6>
                <p class="detail-title">FB Name</p>
                <h6 class="details-info">{{$customer->fb_name}}</h6>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i>
        </button>
        <br><br>
        <table class="table table-striped">
            <tbody id="data">

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
{{--                {{dd($customer)}}--}}
                <form action="{{route('products.store', $customer->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Details</label>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" required>
                                </div>
                                <div class="col-3">
                                    <input type="text" name="price" class="form-control" placeholder="Price" required>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control" name="category" id="exampleFormControlSelect1" required>
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="Printed">Printed</option>
                                            <option value="Plain">Plain</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="details" class="form-control" placeholder="Details" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mock-Up Picture</label>
                            <img src="{{ url('images/image_not_available.png') }}" id="productPic" alt="" width="465" style="border: 3px solid #ddd;">
                            <input type="file" onchange="imagePreview.call(this)" id="file" name="product_picture"  value="upload picture">
                            <label for="file" class="file-button" ><i class="fas fa-camera-retro" style="paddin-right:10px"></i> Choose a photo</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--                {{dd($customer)}}--}}
                <form id="editForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Details</label>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                                </div>
                                <div class="col-3">
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price" required>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control" name="category" id="category" required>
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="Printed">Printed</option>
                                            <option value="Plain">Plain</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="details" id="details" class="form-control" placeholder="Details" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mock-Up Picture</label>
                            <img src="{{ url('images/image_not_available.png') }}" id="productPic2" alt="" width="465" style="border: 3px solid #ddd;">
                            <input type="file" id="file2" name="product_picture"  value="upload picture">
                            <label for="file2" class="file-button" ><i class="fas fa-camera-retro" style="padding-right:10px"></i> Choose a photo</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function imagePreview(){
            var reader = new FileReader();
            var imageField = document.getElementById("productPic");
            reader.onload = function(){
                if(reader.readyState == 2){
                    imageField.src = reader.result;
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // $(document).on('change', '#file2', function () {
        //     var reader = new FileReader();
        //     var imageField = document.getElementById("productPic2");
        //     reader.onload = function(){
        //         console.log(reader.readyState);
        //         if(reader.readyState == 2){
        //             imageField.src = reader.result;
        //             // console.log(imageField.src);
        //         }
        //     }
        //     reader.readAsDataURL(event.target.files[1]);
        // })

        // function imagePreview2(){
        //     console.log('Hahahaha');
        //     var reader = new FileReader();
        //     var imageField = document.getElementById("productPic2");
        //     console.log(imageField);
        //     reader.onload = function(){
        //         if(reader.readyState == 2){
        //             imageField.src = reader.result;
        //             console.log(imageField.src);
        //         }
        //     }
        //     reader.readAsDataURL(event.target.files[1]);
        // }



        fetch('{{route('products.index', $customer->id)}}').then(
            res=>{
                res.json().then(
                    data=>{
                        console.log(data);
                        if (data.length > 0){
                            var temp = "";

                            data.forEach((u)=>{
                                temp += '<tr>';
                                temp += '<td><button type="button" class="btn btn-light btn-circle btn-circle m-1 editModalShow" id="'+u.id+'" data-toggle="modal"  data-target="#editModal"><i class="fas fa-edit"></i></button></td>';
                                temp += '<td><img src="http://127.0.0.1:8000/images/'+u.picture+'" width="500"></td>';
                                temp += '<td><a class="btn btn-primary btn-sm" style="color: white">Show Progress</a><br><br><center><h6>Details</h6><h6>'+u.details+'</h6></center></td>';
                                temp += '<td><center><h6>Quantity</h6><h3>'+u.quantity+'</h3><h6>Category</h6><h3>'+u.category+'</h3></center></td>';
                                temp += '<td><center><h6>Price</h6><h3>'+u.price+'</h3><h6>Total Price</h6><h3>'+u.quantity * u.price+'</h3></center></td></tr>';
                            })
                            document.getElementById("data").innerHTML = temp;
                        }
                    }
                )
            }
        )


        $(document).on('click', '.editModalShow', function () {
            var customer = "{{$customer->id}}";
            var id = $(this).attr('id');
            var route = "http://127.0.0.1:8000/api/customers/"+customer+"/products/"+id;
            var updateRoute = "http://127.0.0.1:8000/customers/"+customer+"/products/"+id;
            $('#editForm').attr('action', updateRoute);

            $.ajax({
                url: route,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#quantity').val(data.product.quantity);
                    $('#details').val(data.product.details);
                    $('#price').val(data.product.price);
                    $('#category').val(data.product.category);
                    $('#productPic2').attr('src', 'http://127.0.0.1:8000/images/'+data.product.picture);
                },
            });
        });
    </script>

@endsection