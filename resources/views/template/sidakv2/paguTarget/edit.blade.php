<!-- Modal -->
<div id="modal-edit-{{ $index }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <form method="post">
        <div class="modal-body">



          <div class="form-group has-feedback">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $data->username }}">
          </div>

          <div class="form-group has-feedback">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Username" value="{{ $data->name }}">
          </div>


          <div class="form-group has-feedback">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="email" value="{{ $data->email }}">
          </div>

          <div class="form-group has-feedback">
            <label>Phone</label>
            <input type="text" class="form-control" placeholder="phone" value="{{ $data->phone }}">
          </div>


          <div class="form-group has-feedback">
            <label>NIP</label>
            <input type="text" class="form-control" placeholder="NIP" value="{{ $data->nip }}">
          </div>

          <div class="form-group has-feedback">
            <label>Penanggung Jawab</label>
            <input type="text" class="form-control" placeholder="leader_name" value="{{ $data->name }}">
          </div>

          <div class="form-group has-feedback">
            <label>NIP Penanggung Jawab</label>
            <input type="text" class="form-control" placeholder="leader_nip" value="{{ $data->leader_nip }}">
          </div>


          <div class="form-group has-feedback">
            <label>Penanggung Jawab</label>
            <input type="text" class="form-control" placeholder="leader_name" value="{{ $data->name }}">
          </div>

          <div class="form-group has-feedback">
            <label>NIP Penanggung Jawab</label>
            <input type="text" class="form-control" placeholder="leader_nip" value="{{ $data->leader_nip }}">
          </div>







        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>

  </div>
</div>