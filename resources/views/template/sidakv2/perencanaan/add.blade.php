<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <form method="post" action="{{ url('/perencanaan') }}">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Perencanaan</h4>
      </div>
      <div class="modal-body">
        @csrf
        <div class="form-group has-feedback {{ $errors->has('lokasi') ? ' has-error' : '' }}" >
            <label>Lokasi</label>
            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
            @if ($errors->has('lokasi'))
                <span class="help-block">
                <strong>{{ $errors->first('lokasi') }}</strong>
            </span>
            @endif
          </div>

        <div class="form-group has-feedback {{ $errors->has('nama_pejabat') ? ' has-error' : '' }}" >
            <label>Nama Pejabat</label>
            <input type="text" class="form-control" name="nama_pejabat" placeholder="Nama Pejabat">
            @if ($errors->has('nama_pejabat'))
                <span class="help-block">
                <strong>{{ $errors->first('nama_pejabat') }}</strong>
            </span>
            @endif
          </div>
                
        
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </form>

  </div>
</div>