<a href="{{ route('kategori.edit', $kategori_id) }}" class="btn btn-sm btn-warning">
    <i class="fas fa-edit"></i> Edit
</a>

<form action="{{ route('kategori.destroy', $kategori_id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">
        <i class="fas fa-trash"></i> Hapus
    </button>
</form>
