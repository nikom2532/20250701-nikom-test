<h1>เพิ่มสินค้าใหม่</h1>

<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <label>ชื่อสินค้า: <input name="name" /></label><br>
    <label>รายละเอียด: <textarea name="description"></textarea></label><br>
    <label>ราคา: <input name="price" /></label><br>
    <button type="submit">บันทึก</button>
</form>
