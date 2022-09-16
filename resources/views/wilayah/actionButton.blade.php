<div class="d-flex">
    <a href="{{ route('wilayah.show', $id) }}" class="btn btn-sm btn-info mr-2">Detail</a>
    <a href="{{ route('wilayah.edit', $id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
    <form action="{{ route('wilayah.delete', $id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Hapus Data Ini ?')">Delete</button>
    </form>
</div>  