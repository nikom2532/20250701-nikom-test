<!-- resources/views/products/edit.blade.php -->
<h1>แก้ไขสินค้า</h1>

<form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PUT')

    <label>ชื่อสินค้า:
        <input name="name" value="{{ $product->name }}" />
    </label><br>

    <label>รายละเอียด:
        <textarea name="description">{{ $product->description }}</textarea>
    </label><br>

    <label>ราคา:
        <input name="price" value="{{ $product->price }}" />
    </label><br>

    <button type="submit">อัปเดต</button>
</form>
