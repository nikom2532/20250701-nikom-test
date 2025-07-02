<!-- resources/views/products/index.blade.php -->
<h1>รายการสินค้า</h1>
<a href="{{ route('products.create') }}">เพิ่มสินค้าใหม่</a>

<ul>
@foreach($products as $product)
    <li>
        {{ $product->name }} - ฿{{ $product->price }}

        <!-- ปุ่มแก้ไข -->
        <a href="{{ route('products.edit', $product->id) }}">แก้ไข</a>

        <!-- ปุ่มลบ -->
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
        </form>
    </li>
@endforeach
</ul>
