{{-- form input --}}
<div class="row justify-content-center d-md-flex h-100" style="padding: 5%">

    <hr>
    <div style="padding: 2%">

        {{-- <div class="mb-3" style="padding-bottom: 1%">
            <h4>Setting - Halaman Settings</h4>
        </div> --}}
        {{-- <form action="{{ route('settings') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">PIN</label>
                <input type="pin" class="form-control" id="pin" name="pin" placeholder="Masukkan Pin"
                    value="{{ old('pin') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Server Key</label>
                <input type="server_key" class="form-control" id="server_key" name="server_key"
                    placeholder="Masukkan Server Key" value="{{ old('server_key') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul Header</label>
                <input type="judul" class="form-control" id="judul" name="judul"
                    placeholder="Masukkan Judul Header" value="{{ old('judul') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                <input type="deskripsi" class="form-control" id="deskripsi" name="deskripsi"
                    placeholder="Masukkan Deskripsi" value="{{ old('deskripsi') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">String Logo</label>
                <input type="string_logo" class="form-control" id="string_logo" name="string_logo"
                    placeholder="Masukkan String Logo" value="{{ old('string_logo') }}">
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Background Image</label>
                <input class="form-control" type="file" id="image" name="image" value="{{ old('image') }}">
            </div>

            <div class="mb-3" style="padding: 2%">
                <button type="submit" class="btn btn-secondary">Simpan Settings</button>
            </div>
        </form> --}}

        {{-- <form action="/proses" method="post">
            {{ csrf_field() }}
            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input class="form-control" type="text" name="nama" value="{{ old('nama') }}">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                    <input class="form-control" type="text" name="pekerjaan" value="{{ old('pekerjaan') }}">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Usia</label>
                    <input class="form-control" type="text" name="usia" value="{{ old('usia') }}">
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Proses">
            </div>
        </form> --}}

        <form action="{{url('proses')}}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input class="form-control" type="text" name="nama" id="nama">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                    <input class="form-control" type="text" name="pekerjaan" id="pekerjaan">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Usia</label>
                    <input class="form-control" type="text" name="usia" id="usia">
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Proses">
            </div>
        </form>
    </div>
    <hr>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
