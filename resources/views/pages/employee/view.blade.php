@extends('layouts.main')

@section('content')

    <h1>Employee List</h1>


    <!-- Button trigger modal -->


    <!-- Modal -->




    {{--    <a href="{{route('products.create')}}">ADD PRODUCT</a>--}}
    <table class="display" id="table_id">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col"></th>
{{--            <th scope="col"></th>--}}
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($employees as $employees)
            <tr>
                <td>{{ $employees->id }}</td>
                <td>{{ $employees->full_name }}</td>
                <td>{{ $employees->phone_number }}</td>
                <td><a href="{{ route('employees.show' , $employees->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
{{--                <td><a href="{{ route('employees.edit' , $employees->id) }}" class="btn btn-secondary btn-sm">Edit</a></td>--}}
                <td><form action="{{ route('employees.destroy' , $employees->id) }}" method="POST"> @csrf @method('DELETE') <button type="submit" name="submit" value="Delete" class="btn btn-danger btn-sm" id=""><i class="fas fa-trash-alt"></i></td></form>
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