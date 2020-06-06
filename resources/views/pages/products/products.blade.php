@extends('layouts.main')

@section('content')

    <h1>Product List</h1>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        Add Product
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
{{--                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Name</label>--}}
{{--                            <input type="text" name="product_name" class="form-control" id="exampleFormControlInput1">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Details</label>--}}
{{--                            <textarea class="form-control" name="details" rows="3"></textarea>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Customer</label>--}}
{{--                            <input type="text" name="customer" class="form-control">--}}
{{--                        </div>--}}
{{--                        <div class="book-pic">--}}
{{--                            <img src=" {{ url('images/nobookcover.jpg') }} " id="bookpic" alt="" width="350">--}}
{{--                            <img src="{{ url('images/nobookcover.png') }}" id="productPic" alt="" width="350" style="border: 3px solid #ddd;">--}}
{{--                            <input type="file" onchange="imagePreview.call(this)" id="file" name="product_picture"  value="upload picture">--}}
{{--                            <label for="file" class="file-button" ><i class="fas fa-camera-retro" style="paddin-right:10px"></i> Choose a photo</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-primary">Save</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
    <br><br>




{{--    <a href="{{route('products.create')}}">ADD PRODUCT</a>--}}
    <table class="display" id="table_id">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Details</th>
            <th scope="col">Customer</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->details }}</td>
                <td>{{ $product->customer }}</td>
                <td><a href="{{ route('products.show' , $product->id) }}" class="btn btn-primary btn-sm">View</a></td>
                <td><a href="{{ route('products.edit' , $product->id) }}" class="btn btn-secondary btn-sm">Edit</a></td>
                <td><form action="{{ route('products.destroy' , $product->id) }}" method="POST"> @csrf @method('DELETE') <input type="submit" name="submit" value="Delete" class="btn btn-danger btn-sm" id=""> </form></td>
            </tr>
        @endforeach
        </tbody>
    </table>

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
    </script>

@endsection