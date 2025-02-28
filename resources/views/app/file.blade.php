<form action="{{ url('pdf') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="pdf" class="form-label">Upload PDF</label>
        <input type="file" name="pdf" class="form-control" id="pdf" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
