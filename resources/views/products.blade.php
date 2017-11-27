@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price Per Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ $product['price_per_qty'] }}</td>
                            <td class="text-right">{{ $product['total_price'] }}</td>
                            <td>
                                <button data-id="{{ $key }}" class="btn btn-info btn-edit" data-toggle="modal" data-target="#update-product">Edit</button>
                                <a href="{{ route('delete-product',['id' => $key]) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">Total Price</td>
                        <td class="text-right">{{ $total }}</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="update-product" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('update-product') }}" method="post" id="update-product-form">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click','.btn-edit',function () {
                var id = $(this).data('id');
                var url = "{{ route('get-product') }}/"+id;

                var formUrl = "{{ route('update-product') }}/"+id;

                $.ajax({url: url, success: function(result){
                    console.log(result);
                    $("#update-product-form").attr('action',formUrl);
                    $("#update-product-form input[name='name']").val(result.name);
                    $("#update-product-form input[name='quantity']").val(result.quantity);
                    $("#update-product-form input[name='price_per_qty']").val(result.price_per_qty);
                }});
            });
        });
    </script>
@endsection