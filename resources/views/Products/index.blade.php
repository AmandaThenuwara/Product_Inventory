<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Product List</h1>
    <div>
        @if (session('success'))
            {{ session('success') }}
            
        @endif
    </div>
    <div>
        <a href="{{ route('products.create') }}">Create New Product</a>
    </div>
    <div>
        <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td><a href="{{ route('products.edit', ['product' => $product->id]) }}">Edit</a></td>

                    <td>
                        <form action="{{ route('products.destroy', ['product' => $product]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                </tr>
                @endforeach 

        
        </table>
    </div>
</body>
</html>