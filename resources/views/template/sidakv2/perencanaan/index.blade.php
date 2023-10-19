@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">    
    <div class="row padding-default" style="margin-bottom: 20px">
		<div class="col-lg-4 col-sm-12">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                        <div class="media">
                            <div class="media-body text-left">
                                <span>Total Rencana Pengawasan</span>
                                <h3 class="card-text" id="total-rencana-pengawasan"></h3>
                            </div>
                        </div>
                </div>
            </div>
        </div>
		<div class="col-lg-4 col-sm-12">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total Rencana Bimsos</span>
                            <h3 class="card-text" id="total-rencana-bimsos"></h3>
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<div class="col-lg-4 col-sm-12">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total Penyelesaian Masalah</span>
                            <h3 class="card-text" id="total-rencana-masalah"></h3>
                        </div>
                    </div>
			    </div>
			</div>
		</div>
	</div>

    <div class="row">
        <div class="col-sm-2" style="margin-bottom: 9px;">
            <select class="selectpicker" data-style="btn-default" id="periode_id" title="Pilih Periode"></select>
        </div> 	
        <div class="col-sm-2" style="margin-bottom: 9px;">
            <select class="selectpicker" name="type_daerah" data-style="btn-default" id="type_daerah" title="Pilih Type Wilayah">
                <option value="">Pilih Tipe Wilayah</option>
                <option value="Provinsi">Provinsi</option>
                <option value="Kabupaten">Kabupaten</option>
            </select>
        </div>
        <div class="col-sm-2" style="margin-bottom: 9px;">
            <select id="daerah_id" class="selectpicker" data-style="btn-default" name="daerah_id" title="Pilih Daerah" data-live-search="true" disabled>
                <option value="">Pilih Daerah</option>
            </select>
        </div>
        <div class="col-sm-2" style="margin-bottom: 9px;">    
            <select id="search_status" class="selectpicker" data-style="btn-default" title="Pilih Status">
                <option value="1">Draft</option>
                <option value="2">Request Dokumen</option>
                <option value="3">Request Edit</option>
                <option value="4">Terkirim/Waiting</option>
                <option value="5">Approved</option>
                <option value="6">Perlu Perbaikan</option>
            </select>
        </div> 	
        <div class="col-sm-2" style="margin-bottom: 9px;">
            <input type="text" id="search_text" class="form-control border-radius-13" placeholder="Pencarian">
        </div> 	
        <div class="col-lg-2">
            <div class="btn-group">
                <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                <button id="Reset" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
    </div> 	
    
	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
            <div class="pull-left padding-9-0 margin-left-button">
                <select id="row_page" class="selectpicker" data-style="btn-default" >
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">All</option>
                </select>
            </div>  
            <div id="ShowChecklist" style="display:none;" class="pull-left padding-9-0 margin-left-button">
                <button type="button" disabled id="approve-selected" class="btn btn-danger border-radius-10">
                     Approve
                </button>
            </div>
             <div  class="pull-left padding-9-0 margin-left-button" >
                <button type="button" id="ExportButton" class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>                    
            <div id="ShowAdd" style="display:none;" class="pull-left padding-9-0">
                <a href="{{ url('perencanaan/add') }}" class="btn btn-primary border-radius-10" >
                    Tambah Data
                </a> 
            </div>
		</div>
		<div  class="pull-right width-50">
			<ul id="pagination" class="pagination-table pagination"></ul>
		</div>
	</div>
</section>

<div class="content">
	<div class="clearfix"></div>
	<div class="clearfix"></div> 

	<div class="box box-solid box-primary">
		<div class="box-body">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th rowspan="2" id="ShowChecklistAll" style="display:none;" class="th-checkbox">
                                <input id="select-all" class="border-left-table" type="checkbox">
                            </th>
							<th rowspan="2"><div id="ShowChecklistAll" style="display:none;" class="split-table"></div><span>No</span></th>
							<th rowspan="2"><span class="border-left-table">Nama Daerah </span></th>
							<th rowspan="2"><span class="border-left-table">Periode </span></th>
							<th colspan="3" class="text-center"><span class="border-left-table pull-left">&nbsp;</span>Pengawasan </th>
							<th colspan="2" class="text-center"><span class="border-left-table pull-left">&nbsp;</span>Bimsos </th>
							<th colspan="3" class="text-center"><span class="border-left-table pull-left">&nbsp;</span>Penyelesaian Masalah </th>
							<th rowspan="2"><span class="border-left-table">Promosi </span></th>
							<th rowspan="2"><span class="border-left-table">Total </span></th>
							<th rowspan="2"><span class="border-left-table">Status </span></th>
							<th rowspan="2"><span class="border-left-table">Update </span></th>
							<th rowspan="2"><span class="border-left-table">Aksi </span> </th>
						</tr>
						<tr>							
							<th><span class="border-left-table">Analisa </span></th>
							<th><span class="border-left-table">Inspeksi </span></th>
							<th><span class="border-left-table">Evaluasi </span></th>
							<th><span class="border-left-table">Perizinan </span></th>
							<th><span class="border-left-table">Pengawasan </span></th>
							<th><span class="border-left-table">Identifikasi </span></th>
							<th><span class="border-left-table">Realisasi </span></th>
							<th><span class="border-left-table">Evaluasi </span></th>
						</tr>
					</thead>

					<tbody id="content"></tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="pull-left full">
      <div id="total-data" class="pull-left width-25"></div>    
    </div>
</div>

<div id="modal-reqrevisi" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request Edit Perencanaan</h4>
               </div>
               <div class="modal-body">
                    <div class="form-group">
                         <label>Alasan Permintaan Edit Data</label>
                         <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_revisi_inp" name="alasan_revisi" placeholder="Alasan Edit"></textarea>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" id="reqrevisi" class="btn btn-warning">Request Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<div id="modal-reqedit" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request Edit Perencanaan</h4>
               </div>
               <div class="modal-body">
                    <div class="form-group">
                         <label>Alasan Permintaan Edit Data</label>
                         <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_edit_inp" name="alasan_edit" placeholder="Alasan Edit"></textarea>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" id="reqedit" class="btn btn-warning">Request Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<div id="modal-log" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Log Data Perbaikan/Request Edit</h4>
      </div>

      <div class="modal-body" style="height: 500px; overflow-y: auto;">        
        <div class="row">
          <div class="card-body table-responsive">
            <table id="dataLog" class="table table-hover text-nowrap" style="margin: 20px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Alasan</th>
                  <th>Dibuat Oleh</th>
                  <th>Tanggal Dibuat</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

@include('template/sidakv2/perencanaan.export')

<script type="text/javascript">
    $(document).ready(function() {
        const itemsPerPage = 10;
        let currentPage = 1; 
        let previousPage = 1; 
        const visiblePages = 5; 
        let page = 1;
        var periode = [];
        var list = [];
        
        $.ajax({
            url: BASE_URL +'/api/select-periode?type=GET&action=perencanaan',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $.each(data.result, function(index, option) {
                    $('#periode_id').append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                });
                $('#periode_id').selectpicker('refresh');
            },
            error: function(error) {
                console.error(error);
            }
        });

        $('#type_daerah').on('change', function () {
            let type_daerah = $('#type_daerah').val();
            let url = type_daerah === 'Provinsi' ? 'select-province' : 'select-kabupaten';

            $.ajax({
              url: BASE_URL +'/api/' + url,
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                  var select =  $('#daerah_id')
                  $.each(data, function(index, option) {
                      select.append($('<option>', {
                        value: option.value,
                        text: option.text
                      }));
                  });
                 select.prop('disabled', false);
                 select.selectpicker('refresh');
              },
              error: function(error) {
                console.error(error);
              }
            });
        });

        $('#row_page').on('change', function() {
            var value = $(this).val();         
            if(value)
            {   
                const content = $('#content');
                content.empty();
                let row = ``;
                row +=`<tr><td colspan="12" align="center"> <b>Loading ...</b></td></tr>`;
                content.append(row);
                let search = $('#periode_id').val();

                if(search !='')
                {
                    var url = BASE_URL + `/api/perencanaan/search?page=${page}&per_page=${value}`;
                    var method = 'POST';
                } else {
                    var url = BASE_URL + `/api/perencanaan?page=${page}&per_page=${value}`;
                    var method = 'GET';
                }

                $.ajax({
                    url: url,
                    method: method,
                    data:{'search':search},
                    success: function(response) {
                        list = response.data;
                        resultTotal(response.total);
                        updateContent(response.data, response.options);
                        updatePagination(response.current_page, response.last_page);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }    
        });

        $('#select-all').on('change', function() {
            var nonDisabledCheckboxes = $('.item-checkbox:not(:disabled)');
            nonDisabledCheckboxes.prop('checked', $(this).is(':checked'));
            const checkedCount =  $('.item-checkbox:checked').length;
            if(checkedCount >0)
            {
                $('#approve-selected').prop("disabled", false);
            } else {
                $('#approve-selected').prop("disabled", true);
            }
        });        

        $('#approve-selected').on('click', function() {
            const selectedIds = [];
            $('.item-checkbox:checked').each(function() {
                selectedIds.push($(this).data('id'));
            });

            Swal.fire({
                    title: 'Apakah Anda Yakin Approve Perencanaan?',			    
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya'
            }).then((result) => {
                    if (result.isConfirmed) {
                        approveItems(selectedIds);
                        Swal.fire(
                            'Approved!',
                            'Data berhasil diapprove.',
                            'success'
                        ).then((act) => {
                            if (act.isConfirmed) {
                                window.location.replace('/perencanaan');
                            }
                        });
                    }
            });            
        });

        $('.item-checkbox').on('change', function() {
            const allChecked = $('.item-checkbox:checked').length === $('.item-checkbox').length;
            $('.select-all').prop('checked', allChecked);
        });

        $("#ExportButton").click(function() {
            $.ajax({
                url: BASE_URL+ `/api/perencanaan?page=${page}&per_page=${itemsPerPage}`,
                method: 'GET',
                success: function(response) {
                    exportData(response.data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $('#Reset').on('click', function() {
            location.reload(true); 
        });

        $('#Search').click( () => {
            var daerah_id = $("#daerah_id").val();
            var periode_id = $('#periode_id').val(); 
            var search_status = $('#search_status').val();
            var search_text = $('#search_text').val();

            const content = $('#content');
            content.empty();
            let row = ``;
            row +=`<tr><td colspan="12" align="center"> <b>Loading ...</b></td></tr>`;
            content.append(row);

            $.ajax({
                url: BASE_URL + `/api/perencanaan/search?page=${page}&per_page=${itemsPerPage}`,
                data:{'daerah_id':daerah_id,'periode_id':periode_id,'search_status':search_status,'search_text':search_text},
                method: 'POST',
                success: function(response) {                        
                    resultTotal(response.total);
                    updateContent(response.data, response.options);
                    updatePagination(response.current_page, response.last_page);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        function approveItems(ids) {        
            $.ajax({
                url:  BASE_URL +`/api/perencanaan/approve_selected`,
                method: 'POST',
                data: { data: ids },
                success: function(response) {
                    fetchData(page);
                },
                error: function(error) {
                    console.error('Error deleting items:', error);
                }
            });
        }

        function fetchData(page) {
            const content = $('#content');
            content.empty();
          
            let row = ``;
                row +=`<tr><td colspan="12" align="center"> <b>Loading ...</b></td></tr>`;
                content.append(row);

            $.ajax({
                url: BASE_URL+ `/api/perencanaan?page=${page}&per_page=${itemsPerPage}`,
                method: 'GET',
                success: function(response) {
                    list = response.data;
                    resultTotal(response.total);
                    listOptions(response.options);
                    updateContent(response.data, response.options);
                    updatePagination(response.current_page, response.last_page);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }        

        function updateContent(data, options) {
            const content = $('#content');            
           
            var total_pengawasan = 0;
            var total_bimsos = 0;
            var total_masalah = 0;
            
            content.empty();

            data.forEach(function(item, index) {
                let row = ``;
                row +=`<tr>`;

                
                  options.forEach(function(opt, arr) 
                  {
                     if(opt.action == 'approval')
                     {
                        if(opt.checked == true)
                        {
                             row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
                        }
                     }       
                  }); 

                total_pengawasan += item.total_rencana_pengawasan;
                total_bimsos += item.total_rencana_bimsos;
                total_masalah += item.total_rencana_masalah;

                var download_link = '<a href="'+BASE_URL+'/file/perencanaan/' + item.lap_rencana + '" class="btn btn-danger" title="Download PDF" target="_blank" style="margin-right: 4px"><i class="fa fa-download"></i></a>';

                row +=`<td class="table-padding-second">${item.number}</td>`;
                row +=`<td class="table-padding-second">${item.nama_daerah}</td>`;
                row +=`<td class="table-padding-second">${item.periode}</td>`;
                row +=`<td class="table-padding-second text-right">${item.pengawas_analisa_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.pengawas_inspeksi_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.pengawas_evaluasi_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.bimtek_perizinan_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.bimtek_pengawasan_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.penyelesaian_identifikasi_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.penyelesaian_realisasi_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.penyelesaian_evaluasi_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.promosi_pengadaan_pagu_convert}</td>`;
                row +=`<td class="table-padding-second text-right">${item.total_pagu}</td>`;
                row +=`<td class="table-padding-second">${item.status}</td>`;
                row +=`<td class="table-padding-second">${item.updated_at}</td>`;
                row +=`<td>`; 
                    row +=`<div class="btn-action">`;
                    if(item.lap_rencana != '') {                                   
                        row += download_link;
                    }

                    row +=`<button id="Detail" data-param_id="${item.id}" type="button" class="btn btn-primary" title="Detail Data"><i class="fa fa-eye"></i></button>`;

                    if(item.access == 'pusat' && item.status_code == 16 && item.request_edit == 'false') {
                        row += '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-reqrevisi" title="Request Edit"><i class="fa fa-pencil"></i></button>';
                    }               

                    if(item.access == 'daerah' && ([14, 15, 16].includes(item.status_code) && item.request_edit === 'false') || (item.status_code === 14 && item.request_edit === 'request_doc')) {                         
                        row += '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-reqedit" title="Request Edit"><i class="fa fa-pencil"></i></button>';
                    }

                    if(item.status_code == 13)
                    {    
                        options.forEach(function(opt, arr) 
                        {
                            if(opt.action == 'update')
                            {
                                if(opt.checked == true)
                                {                                    
                                  row +=`<button id="Edit" data-param_id="${item.id}" type="button" class="btn btn-primary" title="Edit Data"><i class="fa fa-pencil"></i></button>`;
                                } 
                            }
                            if(opt.action == 'delete')
                            {
                                if(opt.checked == true)
                                {                                 
                                  row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`; 
                                } 
                            }    
                        });   

                    } else {
                    
                        row +=`<button disabled type="button" class="btn btn-primary" title="Edit Data"><i class="fa fa-pencil"></i></button>`;
                        row +=`<button disabled type="button" class="btn btn-primary" title="Hapus Data"><i class="fa fa-trash"></i></button>`;
                    }

                    if(item.alasan_edit !== null || item.alasan_revisi !== null || item.alasan_unapprove !== null || item.alasan_unapprove_doc !== null) {
                        row += `<button id="Log" data-param_id="${item.id}" data-toggle="modal" data-target="#modal-log" type="button" data-toggle="tooltip" data-placement="top" title="Log Data" class="btn btn-primary modalLog"><i class="fa fa-history" ></i></button>`;
                    }

                    row +=`</div>`;
                    row +=`</td>`;

                row +=`</tr>`; 
                content.append(row);
            });            

            $('#total-rencana-pengawasan').html('<b> Rp. '+accounting.formatNumber(total_pengawasan, 0, ".", ".")+'</b>');
            $('#total-rencana-bimsos').html('<b> Rp. '+accounting.formatNumber(total_bimsos, 0, ".", ".")+'</b>');
            $('#total-rencana-masalah').html('<b> Rp. '+accounting.formatNumber(total_masalah, 0, ".", ".")+'</b>');

            $('.item-checkbox').on('click', function() {
                const checkedCount = $('.item-checkbox:checked').length;
                if(checkedCount>0)
                {
                    $('#approve-selected').prop("disabled", false);
                } else {
                    $('#approve-selected').prop("disabled", true);
                }  
            });

            $( "#content" ).on( "click", "#Approve", (e) => {
             
                let id = e.currentTarget.dataset.param_id;                
                Swal.fire({
                    title: 'Apakah Anda Yakin Approve Perencanaan Ini?',			    
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya'
			    }).then((result) => {
			        if (result.isConfirmed) {
                        approveItem(id);
                        Swal.fire(
                            'Approved!',
                            'Data berhasil diapprove.',
                            'success'
                        );
			        }
			    });
            });

            $( "#content" ).on( "click", "#Detail", (e) => {
                let id = e.currentTarget.dataset.param_id;
                window.location.replace('/perencanaan/detail/'+ id);   
            });

            $( "#content" ).on( "click", "#Edit", (e) => {
                let id = e.currentTarget.dataset.param_id;
                window.location.replace('/perencanaan/edit/'+ id);   
            }); 

            $( "#content" ).on( "click", "#Destroy", (e) => {
                let id = e.currentTarget.dataset.param_id;
                Swal.fire({
                    title: 'Apakah anda yakin hapus?',                    
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id);                        
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                    }
                });
            });
            
            $( "#content" ).on( "click", "#Log", (e) => {
                let id = e.currentTarget.dataset.param_id;
                $.ajax({
                    url: BASE_URL + '/api/perencanaan/log/' + id,
                    method: 'GET',
                    success: function(data_log) {             
                        dataLogRequset(data_log);
                    },
                    error: function() {
                        alert('Gagal mengambil data.');
                    }
                })
            });

            $("#reqedit").click( () => {
                Swal.fire({
                        title: 'Apakah Anda Yakin Request Edit Perencanaan Ini?',			    
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya'
                }).then((result) => {
                        if (result.isConfirmed) {
                            var form = {
                                "alasan_edit": $("#alasan_edit_inp").val()
                            };
                            if($("#alasan_edit_inp").val() != '') {  
                                reqeditItem(form);
                            } else {
                                Swal.fire(
                                    'Gagal.',
                                    'Alasan belum diisi.',
                                    'error'
                                );
                            }
                        }
                });
            });
            
            $("#reqrevisi").click( () => {
                Swal.fire({
                        title: 'Apakah Anda Yakin Request Edit Perencanaan Ini?',			    
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya'
                }).then((result) => {
                        if (result.isConfirmed) {
                            var form = {
                                "alasan_revisi": $("#alasan_revisi_inp").val()
                            };
                            if($("#alasan_revisi_inp").val() != '') {  
                                reqrevisiItem(form);
                            } else {
                                Swal.fire(
                                    'Gagal.',
                                    'Alasan belum diisi.',
                                    'error'
                                );
                            }
                        }
                });
            });

            function reqeditItem(form) {
                $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/reqedit/' + item.id,
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Berhasil Request Edit Data Perencanaan.',
                            icon: 'success',
                            confirmButtonText: 'OK'                        
                        }).then((result) => {
                            if (result.isConfirmed) {
                                    window.location.replace('/perencanaan');
                            }
                        });
                    },
                });
            }

            function reqrevisiItem(form) {
                $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/reqrevisi/' + item.id,
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Berhasil Request Edit Data Perencanaan.',
                            icon: 'success',
                            confirmButtonText: 'OK'                        
                        }).then((result) => {
                            if (result.isConfirmed) {
                                    window.location.replace('/perencanaan');
                            }
                        });
                    },
                });
            }

            function dataLogRequset(data_log) {        
                var tableBody = $('#dataLog tbody');
                tableBody.empty();

                $.each(data_log, function(index, val) {          

                    var date = new Date(val.created_at);

                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + val.type + '</td>' +
                        '<td>' + val.alasan_request + '</td>' +
                        '<td>' + val.created_by + '</td>' +
                        '<td>' + date.toLocaleDateString() + '</td>' +
                        '</tr>';

                    tableBody.append(row);
                });
            }
        }

        function deleteItem(id){
            $.ajax({
                url:  BASE_URL +`/api/perencanaan/`+ id,
                method: 'DELETE',
                success: function(response) {
                    fetchData(page);
                },
                error: function(error) {
                    console.error('Error deleting items:', error);
                }
            });
        }        

        function resultTotal(total){
           $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
        }

        function listOptions(data){

            data.forEach(function(item, index) 
            {
                if(item.action =='create')
                {
                   if(item.checked ==true)
                   {
                       $('#ShowAdd').show();
                       $('#ShowImport').show();
                   }else{
                      $('#ShowAdd').hide();
                      $('#ShowImport').hide();
                   }    
                }

                if(item.action =='approval')
                {
                   if(item.checked ==true)
                   {
                       $('#ShowChecklist').show();
                       $('#ShowChecklistAll').show();
                   }else{
                       $('#ShowChecklist').hide();
                       $('#ShowChecklistAll').hide();
                   } 
                }
           });
        }

        function updatePagination(currentPage, totalPages) {
            const pagination = $('#pagination');

            pagination.empty();

            let startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
            let endPage = Math.min(totalPages, startPage + visiblePages - 1);

            if (currentPage > 1) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="1">«</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable">«</button></li>`);
            }

            if (currentPage > 1) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage - 1}">‹</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item "><button class="pagination-link pagination-disable">‹</button></li>`);
            }

            for (let i = startPage; i <= endPage; i++) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link${i === currentPage ? ' pagination-link--active' : ''}" data-page="${i}">${i}</button></li>`);
            }

            if (currentPage < totalPages) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage + 1}">›</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >›</button></li>`);
            }

            if (currentPage < totalPages) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${totalPages}">»</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >»</button></li>`);
            }

            pagination.find('.page-link').on('click', function() {
                currentPage = parseInt($(this).data('page'));
                fetchData(currentPage);
            });
        }

        fetchData(currentPage);

        function exportData(data)
        {
            const content = $('#exportView');
            content.empty();

            if(data.length>0)
            {
                data.forEach(function(item, index) {
                    let row = ``;
                        row +=`<tr>`;
                        row +=`<td class="padding-text-table">${item.number}</td>`;
                        row +=`<td class="padding-text-table">${item.nama_daerah}gjs</td>`;
                        row +=`<td class="padding-text-table">${item.periode}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_analisa_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_inspeksi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_evaluasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.bimtek_perizinan_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.bimtek_pengawasan_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_identifikasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_realisasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_evaluasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.promosi_pengadaan_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.total_pagu_export}</td>`;
                        row +=`<td class="padding-text-table">${item.status}</td>`;
                        row +=`<td class="padding-text-table">${item.updated_at_export}</td>`;
                        row +=`</tr>`;
                    content.append(row);
                });     
            }     

            ExportExel();   
        }

        function ExportExel()
        {
            var dt = new Date();
            var time =  dt.getDate() + "-"+ (dt.getMonth()+1)  + "-" + dt.getFullYear();

            var table = document.getElementById("perencanaanTable");
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();

            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
            XLSX.writeFile(wb, "Report-data-perencanaan-"+ time +".xlsx");
        }

    });

</script>

@stop

