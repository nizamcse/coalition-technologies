@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('create-product') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="product-name">Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="product-name">Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="product-name">Price Per Item</label>
                    <input type="text" name="price_per_qty" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection