@extends('template/sidakv2/layout.app')
@section('content')
<style>
    .inner {
        max-height: 200px !important;
    }
    .modal-loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 99999;
    }
    .modal-content2 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 4px;
        text-align: center;
    }
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
    #progress-container {
        text-align: center;
    }
    #progress-bar {
        width: 100%;
        background-color: #ccc;
        border-radius: 4px;
    }
    #progress {
        height: 20px;
        background-color: #4caf50;
        border-radius: 4px;
        transition: width 0.3s ease-in-out;
    }
    #progress-label {
        margin-top: 10px;
        font-weight: bold;
    }
</style>

<!-- Modal loading -->
<div id="progressModal" class="modal-loading" style="display: none;">
  <div class="modal-content2">
    <span class="close" id="closeProgressModal">&times;</span>
    <h2>Upload Dokumen</h2>
    <div id="progress-container">
      <div id="progress-bar">
        <div id="progress" style="width: 0%"></div>
      </div>
      <div id="progress-label">0%</div>
    </div>
  </div>
</div>

<section class="content-header pd-left-right-15">    
    <div class="row padding-default" style="margin-bottom: 20px">
        <div class="col-lg-3 col-sm-12">
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
        <div class="col-lg-3 col-sm-12">
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
        <div class="col-lg-3 col-sm-12">
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
        <div class="col-lg-3 col-sm-12">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total </span><span class="label-peta-potensi">Peta Potensi</span>
                            <h3 class="card-text" id="total-rencana-promosi"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row margin-top-bottom-20">
        <div class="col-lg-3 col-sm-12" style="margin-bottom: 9px;">
                 <div id="selectPeriode" class="form-group margin-none"></div>
            </div>          
        
        <div class="col-lg-3 col-sm-12" style="margin-bottom: 9px;">
            <select id="daerah_id" data-live-search="true" class="selectpicker" data-style="btn-default" title="Pilih Daerah"></select>
        </div>
      
        <div class="col-lg-2 col-sm-12" style="margin-bottom: 9px;">    
            <select id="search_status" class="selectpicker" data-style="btn-default" title="Pilih Status">
                <option value="1">Draft</option>
                <option value="2">Request Dokumen</option>
                <option value="3">Request Edit</option>
                <option value="4">Terkirim/Waiting</option>
                <option value="5">Approved</option>
                <option value="6">Perlu Perbaikan</option>
            </select>
        </div>  
        <div class="col-lg-2 col-sm-12" style="margin-bottom: 9px;">
            <input type="text" id="search_text" class="form-control border-radius-13" placeholder="Pencarian">
        </div>  
        <div class="col-lg-2 col-sm-12">
            <div class="btn-group">
                <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                <button id="Reset" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
    </div>  
    
    <div class="col-sm-4 pull-left padding-default full">
        <div class="width-50 pull-left">
            <div class="pull-left padding-9-0 margin-left-button">
                <select id="row_page" class="selectpicker" data-style="bg-navy" >
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
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th rowspan="3"  class=" font-bold" id="ShowChecklistAll" style="display:none;">
                                <input id="select-all" class="border-left-table" type="checkbox">
                            </th>
                            <th rowspan="3" class="text-center font-bold">
                                <div class="split-table"></div>
                            </th>
                            <th rowspan="3"  class=" font-bold">No</th>
                            <th rowspan="3" class="text-center font-bold">
                                <div class="split-table"></div>
                            </th>
                            <th rowspan="3"  colspan="8" class="text-center font-bold">
                                <span class="">Nama Daerah</span>
                            </th>                             
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th colspan="5" class="text-center font-bold">
                                <span class="padding-top-bottom-12">Pengawasan (Rp)</span>
                            </th>
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th colspan="3" class="text-center font-bold">
                                <span class="padding-top-bottom-12">Bimsos (Rp)</span>
                            </th>
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th colspan="5" class="text-center font-bold">
                                <span class="padding-top-bottom-12">Penyelesaian (Rp)</span>
                            </th>
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th rowspan="3"  class="text-center font-bold">
                                <span class="">Peta Potensi (Rp)</span>
                            </th>
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th rowspan="3"  class="text-center font-bold">
                                <span class="">Total (Rp)</span>
                            </th>
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th rowspan="3"  class="text-center font-bold">
                                <span class="padding-top-bottom-12">Status </span>
                            </th>
                            <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                            <th rowspan="3"  class="text-center font-bold">
                                <span class="padding-top-bottom-12">Aksi</span>
                            </th>       
                        </tr>
                         <tr>
                            <th class="text-center font-bold"> 
                                <span class="padding-top-bottom-12">Perencanaan Inspeksi</span>
                            </th>
                            <th><div class="split-table  padding-none"></div> </th>
                            <th class="text-center font-bold">
                                <span class="">Pelaksanaan Inspeksi</span>
                            </th>
                            <th><div class="split-table  padding-none"></div> </th>
                            <th class="text-center font-bold">
                                <span class="">Penilaian Kepatuhan</span>
                            </th>                                   
                            <th class="text-center font-bold"> 
                                <span class="padding-top-bottom-12">Perizinan dan Pengawasan</span>
                            </th>
                            <th><div class="split-table  padding-none"></div> </th>
                            <th class="text-center font-bold"> 
                                <span class="padding-top-bottom-12">LKPM</span>
                            </th>
                            <th class="text-center font-bold"> 
                                <span class="padding-top-bottom-12">Identifikasi</span>
                            </th>
                            <th><div class="split-table  padding-none"></div> </th>
                            <th class="text-center font-bold">
                                <span class="">Penyelesaian</span>
                            </th>
                            <th><div class="split-table  padding-none"></div> </th>
                            <th class="text-center font-bold">
                                <span class="">Evaluasi</span>
                            </th>                                  
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
        var year = new Date().getFullYear();
        var daerah_id = 0;        
      
        fetchData(page,year);
        
        var tmp = JSON.parse(localStorage.getItem('search'));

        if(!tmp)
        {
            getperiode(year);
            getdaerah(daerah_id);            
        }
           
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

        $('#Reset').on('click', function() {
            localStorage.removeItem('search');
            
            $('#periode_id').val();
            $("#daerah_id").val();
            $('#search_status').val();
            $('#search_text').val('');
            location.reload(true); 
        });

        $('#Search').click( () => {
            var daerah_id = $("#daerah_id").val();
            var periode_id = $('#periode_id').val(); 
            var search_status = $('#search_status').val();
            var search_text = $('#search_text').val();    
            
            year = periode_id;

            if(periode_id < 2024) {                         
                $(".label-peta-potensi").text('Promosi');
                $(".label-peta-potensi-table").text('Promosi (Rp.)');
            } else {
                $(".label-peta-potensi").text('Peta Potensi');
                $(".label-peta-potensi-table").text('Peta Potensi (Rp.)');
            }

            var form = {'periode_id':periode_id,'daerah_id':daerah_id,'status':search_status,'search':search_text};
            localStorage.setItem('search', JSON.stringify(form));

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

        $("#ExportButton").click(function() {
            $.ajax({
                url: BASE_URL+ `/api/perencanaan?page=${page}&per_page=all&periode_id=${year}`,
                method: 'GET',
                success: function(response) {
                    exportData(response.data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        function approveItems(ids) {    
            $('#progressModal').show();    
            $.ajax({
                url:  BASE_URL +`/api/perencanaan/approve_selected`,
                method: 'POST',
                data: { data: ids },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#progress').css('width', percentComplete + '%');
                            $('#progress-label').text(percentComplete.toFixed(2) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    $('#progressModal').hide();
                    fetchData(page,year);
                },
                error: function(error) {
                    $('#progressModal').hide();
                    console.error('Error deleting items:', error);
                }
            });
        }

        function fetchData(page,periode_id) {
            const content = $('#content');
            content.empty();
            var url = '';
            var method = '';
            var data = {};
          
            let row = ``;
                row +=`<tr><td colspan="35" align="center"> <b>Loading ...</b></td></tr>`;
                content.append(row);
                var tmp = JSON.parse(localStorage.getItem('search'));
                if(tmp)
                {
                   url = BASE_URL+ `/api/perencanaan/search?page=${page}&per_page=${itemsPerPage}&periode_id=${tmp.periode_id}`;
                   method = 'POST';
                   data = {'search':tmp.search,'daerah_id':tmp.daerah_id,'status':tmp.status};
                   getperiode(tmp.periode_id);
                   getdaerah(tmp.daerah_id);
        
                   $('#search_status').val(tmp.status);
                   $('#search_text').val(tmp.search);
                   $('#search_status').selectpicker('refresh');

                } else {
                   url = BASE_URL+ `/api/perencanaan?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_id}`;
                   method = 'GET';                  
                }   

            $.ajax({
                url: url,
                method: method,
                data:data,
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
            var total_promosi = 0;
            
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
                total_promosi += item.promosi_pengadaan_pagu;

                var download_link = '<a href="'+BASE_URL+'/laporan/rencana/' + item.lap_rencana + '" class="pointer btn-padding-action pull-left" title="Download PDF" target="_blank" style="margin-right: 4px"><i class="fa-icon icon-download"></i></a>';
                 row +=`<td></td>`; 
                row +=`<td >${item.number}</td>`;
                 row +=`<td></td>`;
                row +=`<td colspan="8" >${item.nama_daerah}</td>`;

                row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"> <span>${item.pengawas_analisa_target}</span> - <span> ${item.pengawas_analisa_pagu_convert.replace('Rp ', '')}</span></td>`;
                 row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.pengawas_inspeksi_target}</span> - <span>  ${item.pengawas_inspeksi_pagu_convert.replace('Rp ', '')}</span></td>`;
                 row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.pengawas_evaluasi_target}</span> - <span> ${item.pengawas_evaluasi_pagu_convert.replace('Rp ', '')}</span></td>`;
                row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.bimtek_perizinan_target}</span> - <span> ${item.bimtek_perizinan_pagu_convert.replace('Rp ', '')}</span></td>`;
                row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.bimtek_pengawasan_target}</span> - <span> ${item.bimtek_pengawasan_pagu_convert.replace('Rp ', '')}</span></td>`;
                row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.penyelesaian_realisasi_target}</span> - <span> ${item.penyelesaian_identifikasi_pagu_convert.replace('Rp ', '')}</span></td>`;
                 row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.pengawas_inspeksi_target}</span> - <span> ${item.penyelesaian_realisasi_pagu_convert.replace('Rp ', '')}</span></td>`;
                row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12"><span>${item.penyelesaian_evaluasi_target}</span> - <span> ${item.penyelesaian_evaluasi_pagu_convert.replace('Rp ', '')}</span></td>`;
                 row +=`<td></td>`;
                row +=`<td class="text-width-table padding-top-bottom-12" >${item.promosi_pengadaan_pagu_convert.replace('Rp ', '')}</td>`;
                 row +=`<td></td>`;
                row +=`<td class="text-right" >${item.total_pagu.replace('Rp ', '')}</td>`;
                 row +=`<td></td>`;
                row +=`<td class="text-center" >${item.status}</td>`;
                 row +=`<td></td>`;
                row +=`<td >`; 
                    row +=`<div class="btn-action">`;
                    if(item.lap_rencana !== '' || item.lap_rencana !== null || item.lap_rencana !== 'null') {                                   
                        row += download_link;
                    }

                    row +=`<div id="Detail" data-param_id="${item.id}"  class="pointer btn-padding-action pull-left" title="Detail Data"><i class="fa-icon icon-detail"></i></div>`;

                    if(item.access == 'pusat' && item.status_code == 16) {
                        row += `<div data-param_id="`+ item.id +`" id="RequestEdit" class="pointer btn-padding-action pull-left" data-toggle="modal" data-toggle="tooltip" data-target="#modal-reqrevisi" title="Request Edit"><i class="fa-icon icon-reqedit"></i></div>`;
                    }

                    if(item.status_code == 13)
                    {    
                        options.forEach(function(opt, arr) 
                        {
                            if(opt.action == 'update')
                            {
                                if(opt.checked == true)
                                {                                    
                                  row +=`<div id="Edit" data-param_id="${item.id}"  class="pointer btn-padding-action pull-left" title="Edit Data"><i class="fa-icon icon-edit"></i></div>`;
                                } 
                            }
                            if(opt.action == 'delete')
                            {
                                if(opt.checked == true)
                                {                                 
                                  row +=`<div id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}"  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy" ></i></div>`; 
                                } 
                            }    
                        });   

                    } else {
                    
                        row +=`<div disabled type="button" class="pointer btn-padding-action pull-left" title="Edit Data"><i class="fa-icon icon-edit-disabled"></i></div>`;
                     
                        row +=`<div disabled type="button" class="pointer btn-padding-action pull-left" title="Hapus Data"><i class="fa-icon icon-destroy-disabled"></i></div>`;
                    }

                    if(item.alasan_edit !== null || item.alasan_revisi !== null || item.alasan_unapprove !== null || item.alasan_unapprove_doc !== null) {
                        row += `<div id="Log" data-param_id="${item.id}" data-toggle="modal" data-target="#modal-log" type="button" data-toggle="tooltip" data-placement="top" title="Log Data" class="pointer btn-padding-action pull-left modalLog"><i class="fa-icon icon-detail" ></i></div>`;
                    }

                    row +=`</div>`;
                    row +=`</td>`;

                row +=`</tr>`; 
                content.append(row);                   
            });            

            $('#total-rencana-pengawasan').html('<b> Rp. '+accounting.formatNumber(total_pengawasan, 0, ".", ".")+'</b>');
            $('#total-rencana-bimsos').html('<b> Rp. '+accounting.formatNumber(total_bimsos, 0, ".", ".")+'</b>');
            $('#total-rencana-masalah').html('<b> Rp. '+accounting.formatNumber(total_masalah, 0, ".", ".")+'</b>');
            $('#total-rencana-promosi').html('<b> Rp. '+accounting.formatNumber(total_promosi, 0, ".", ".")+'</b>');

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

            $( "#content" ).on( "click", "#RequestEdit", (e) => {
                let id = e.currentTarget.dataset.param_id;              
                modalRequestEdit(id);
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

        function modalRequestEdit(id) {
            var row = '';

                row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;
                row +=`<div class="modal-header">`;
                row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                row +=`<h4 class="modal-title">Request Edit Perencanaan</h4>`;
                row +=`</div>`;
                row +=`<div class="modal-body">`;
                row +=`<div class="form-group">`;
                row +=`<label>Alasan Permintaan Edit Data</label>`;
                row +=`<textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_revisi_inp" name="alasan_revisi" placeholder="Alasan Edit"></textarea>`;
                row +=`</div>`;
                row +=`</div>`;
                row +=`<div class="modal-footer">`;
                row +=`<button type="button" id="reqrevisi" class="btn btn-warning">Request Edit</button>`;
                row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                row +=`</div>`;
                row +=`</div>`;
                row +=`</div>`;

            $('#modal-reqrevisi').html(row);

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
                            "alasan": $("#alasan_revisi_inp").val(),
                            "jenis_kegiatan": "Perencanaan",
                            "type": "revisi"
                        };
                        if($("#alasan_revisi_inp").val() != '') {  
                            reqrevisiItem(form, id);
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
        }

        function reqrevisiItem(form, id) {
            $.ajax({
                type:"PUT",
                url: BASE_URL+'/api/perencanaan/reqrevisi/' + id,
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
                        window.location.replace('/perencanaan');
                    });
                },
                error: function(error) {
                    console.error('Error request edit data:', error);
                    window.location.replace('/perencanaan');
                }
            });
        }

        function deleteItem(id){
            $('#progressModal').show();
            $.ajax({
                url:  BASE_URL +`/api/perencanaan/`+ id,
                method: 'DELETE',
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#progress').css('width', percentComplete + '%');
                            $('#progress-label').text(percentComplete.toFixed(2) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    $('#progressModal').hide();
                    fetchData(page,year);
                },
                error: function(error) {
                    $('#progressModal').hide();
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
                fetchData(currentPage,year);
            });
        }

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
                        row +=`<td class="padding-text-table">${item.nama_daerah}</td>`;
                        row +=`<td class="padding-text-table">${item.periode}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_analisa_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_analisa_target}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_inspeksi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_inspeksi_target}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_evaluasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.pengawas_evaluasi_target}</td>`;
                        row +=`<td class="padding-text-table">${item.bimtek_perizinan_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.bimtek_perizinan_target}</td>`;
                        row +=`<td class="padding-text-table">${item.bimtek_pengawasan_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.bimtek_pengawasan_target}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_identifikasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_identifikasi_target}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_realisasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_realisasi_target}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_evaluasi_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.penyelesaian_evaluasi_target}</td>`;
                        row +=`<td class="padding-text-table">${item.promosi_pengadaan_pagu}</td>`;
                        row +=`<td class="padding-text-table">${item.total_pagu_export}</td>`;
                        row +=`<td class="padding-text-table">${item.status}</td>`;
                        row +=`<td class="padding-text-table">${item.updated_at_format}</td>`;
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

        function getperiode(periode_id){            
            $('#selectPeriode').html('<select  id="periode_id" title="Pilih Periode"  class="selectpicker"></select>');
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: BASE_URL +'/api/select-periode?type=GET&action=perencanaan',
                success: function(data) {
                    getperiodeList(data);
                    $('#periode_id').val(periode_id).selectpicker('refresh');
                    
                },
                error: function( error) {}
            }); 
            if(periode_id < 2024) {                         
                $(".label-peta-potensi").text('Promosi');
                $(".label-peta-potensi-table").text('Promosi (Rp.)');
            } else {
                $(".label-peta-potensi").text('Peta Potensi');
                $(".label-peta-potensi-table").text('Peta Potensi (Rp.)');
            }
        }

        function getperiodeList(data){
            var select =  $('#periode_id');
                select.empty();
                $.each(data.result, function(index, option) {
                    select.append($('<option>', {
                        value: option.value,
                        text: option.text
                    }));
                });
                select.selectpicker('refresh'); 
                periode = data.result;          
        }

        function getdaerah(daerah_id){
            $.ajax({
                url: BASE_URL +'/api/select-daerah',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, option) {
                        $('#daerah_id').append($('<option>', {
                            value: option.value,
                            text: option.text
                        }));
                    });
                    $('#daerah_id').selectpicker('refresh');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
</script>

@stop

