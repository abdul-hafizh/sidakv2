<!-- Modal -->
<div id="modal-edit-{{ $index }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Perencanaan</h4>
      </div>
      <form  method="patch" action="{{ url('/perencanaan/'. $data->id) }}">
      <div class="modal-body">
        
      @csrf

                <div class="form-group has-feedback" >
                  <label>lokasi</label>
                  <input type="text" class="form-control" name="lokasi" placeholder="lokasi" value="{{ $data->lokasi }}">
                </div>

                <div class="form-group has-feedback" >
                  <label>nama_pejabat</label>
                  <input type="text" class="form-control" name="nama_pejabat" placeholder="nama_pejabat" value="{{ $data->nama_pejabat }}">
                </div>             

       
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </form>
    </div>

  </div>
</div>
