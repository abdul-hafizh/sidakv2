@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <!-- <div  class="col-sm-4 pull-left padding-default full margin-top-bottom-20" >
       
        <div class="pull-right width-50" >
             <div class="pull-left width-50 padding-0-8">
                        <select id="daerah_id"  data-live-search="true" class="selectpicker" data-style="btn-default" title="Pilih Provinsi / Kabupaten"></select>
            </div>
             <div class="pull-left width-50">
                
                <div class="input-group input-group-sm border-radius-20">
                    <input id="search-input" type="text"  placeholder="Cari" class="form-control height-35 border-radius-left">
                    <span class="input-group-btn">
                    <button id="Search" type="button" class="btn btn-search btn-flat height-35 border-radius-right"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
                
        </div>  
    </div>   -->

     <div class="row margin-top-bottom-20">
            <div class="col-lg-3 pd-right">
                <select id="daerah_id"  data-live-search="true" class="selectpicker" data-style="btn-default" title="Pilih Provinsi / Kabupaten"></select>
            </div>   

            <div class="col-lg-3 pd-right ">
                <input type="text" id="search-input" class="form-control border-radius-20" placeholder="Pencarian">
            </div>  

           <div class="col-lg-3 pd-right">
                <div class="btn-group">
                    <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                    <button id="refresh" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
                </div>
            </div>  

     </div>   

    <div class="col-sm-4 pull-left padding-default full">
        <div class="width-50 pull-left">
            <div class="pull-left padding-9-0 margin-left-button">
               
                <select id="row_page" class="selectpicker  border-radius-10" data-style="bg-navy" >
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">All</option>
                </select>
            </div>  

            <div id="ShowChecklist" style="display:none;" class="pull-left padding-9-0 margin-left-button">
                <button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
                     Hapus
                </button>
            </div>

            <div id="ShowExport" style="display:none;"  class="pull-left padding-9-0 margin-left-button" >
                <button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>




                

            <div id="ShowAdd" style="display:none;" class="pull-left padding-9-0" >
                <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
                 Tambah Data
                </button> 
            </div>      
        </div> 

        <div  class="pull-right width-50" >
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
                <table  class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th id="ShowChecklistAll" style="display:none;"  ><input id="select-all" class="span-title" type="checkbox"></th>
                            <th><div  id="ShowChecklistAll" style="display:none;"   class="split-table"></div><span class="span-title">No</span>  </th>
                            
                            <th><div class="split-table"></div><span class="span-title"> Username </span></th>
                            <th><div class="split-table"></div><span class="span-title"> Nama </span></th>
                            <th><div class="split-table"></div><span class="span-title"> Email </span></th>
                            <th><div class="split-table"></div><span class="span-title"> Phone </span></th>
                            <th><div class="split-table"></div><span class="span-title"> Status </span></th> 
                            <th><div class="split-table"></div> <span class="span-title"> Aksi </span> </th>
                        </tr>
                    </thead>

                    <tbody id="content">
                        
                    
                     </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pull-left full">
          <div id="total-data" class="pull-left width-25"></div>    
        </div>
    </div>
     @include('template/sidakv2/user.add')
     @include('template/sidakv2/user.export')
     <script type="text/javascript">
 

 $(document).ready(function() {

    
    
    const itemsPerPage = $('#row_page').val(); // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;
    var text_label = '';
    var photo = '';
    var daerah_id = '';
    var search = '';

    $("#ExportButton").click(function() {
          $.ajax({
            url: BASE_URL+ `/api/user?page=${page}&per_page=all`,
            method: 'GET',
            success: function(response) {
                
                 exportData(response.data);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });



    $.ajax({
        url: BASE_URL +'/api/select-daerah',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate SelectPicker options using received data
            $.each(data, function(index, option) {
                $('#daerah_id').append($('<option>', {
                  value: option.value,
                  text: option.text
                }));
            });

            // Refresh the SelectPicker to apply the new options
            $('#daerah_id').selectpicker('refresh');
        },
        error: function(error) {
            console.error(error);
        }
    });

    
    $('#daerah_id').on('change', function() {
       var value = $(this).val();         
            if(value)
            {   
                 var per_page = $('#row_page').val();
                 const content = $('#content');
                 content.empty();
                 let row = ``;
                 row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                  content.append(row);
                  daerah_id = $('#daerah_id').val();

                  if(daerah_id !='')
                  {
                    var url = BASE_URL + `/api/user/search?page=${page}&per_page=${per_page}`;
                    var method = 'POST';
                  } 

                $.ajax({
                    url: url,
                    method: method,
                    data:{'search':search,'daerah_id':daerah_id},
                    success: function(response) {
                        list = response.data;
                        resultTotal(response.total);
                        listOptions(response.options);
                        
                        updateContent(response.data,response.options);
                        updatePagination(response.current_page, response.last_page);

                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }


    });     

    $('#row_page').on('change', function() {
            var value = $(this).val();         
            if(value)
            {   
                 const content = $('#content');
                 content.empty();
                 let row = ``;
                 row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                  content.append(row);
                 

                  if(search !='' || daerah_id !='')
                  {
                    var url = BASE_URL + `/api/user/search?page=${page}&per_page=${value}`;
                    var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/user?page=${page}&per_page=${value}`;
                    var method = 'GET';
                  }     

                $.ajax({
                    url: url,
                    method: method,
                    data:{'search':search,'daerah_id':daerah_id},
                    success: function(response) {
                        list = response.data;
                        resultTotal(response.total);
                        listOptions(response.options);
                      
                        updateContent(response.data,response.options);
                        updatePagination(response.current_page, response.last_page);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }    
    // Perform other actions based on the selected value
    });


     // "Select All" checkbox
    $('#select-all').on('change', function() {
        $('.item-checkbox').prop('checked', $(this).is(':checked'));
          
         const checkedCount = $('.item-checkbox:checked').length;
         if(checkedCount >0)
         {
            $('#delete-selected').prop("disabled", false);
         }else{
            $('#delete-selected').prop("disabled", true);
         }  
        
    });

     // Refresh selected button
    $('#refresh').on('click', function() {
        fetchData(page);
        $('#search-input').val('');
    });

    // Delete selected button
    $('#delete-selected').on('click', function() {
        const selectedIds = [];
        $('.item-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });

         Swal.fire({
              title: 'Apakah anda yakin hapus?',
            
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya'
            }).then((result) => {
              if (result.isConfirmed) {
                // Perform the delete action here, e.g., using an AJAX request
                // Send selected IDs for deletion (e.g., via AJAX)
                 deleteItems(selectedIds);

                
                Swal.fire(
                  'Deleted!',
                  'Data berhasil dihapus.',
                  'success'
                );
              }
            });
        
    });

    // Individual item checkboxes
    $('.item-checkbox').on('change', function() {
        const allChecked = $('.item-checkbox:checked').length === $('.item-checkbox').length;
        $('.select-all').prop('checked', allChecked);
    });

   


   


   // search btn
    $('#Search').click( () => {
         search = $('#search-input').val();
         
         if(search !='' || daerah_id !='')
         {  
             const content = $('#content');
             content.empty();
             let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
             $.ajax({
                url: BASE_URL + `/api/user/search?page=${page}&per_page=${itemsPerPage}`,
                data:{'search':search,'daerah_id':daerah_id},
                method: 'POST',
                success: function(response) {
                    list = response.data;
                    resultTotal(response.total);
                    listOptions(response.options);
                   
                    updateContent(response.data,response.options);
                    updatePagination(response.current_page, response.last_page);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
         }    
    });

     // search keyup
     $('#search-input').keyup( () => {
         search = $('#search-input').val();
         
         if(search !='' || daerah_id !='')
         {  
             const content = $('#content');
             content.empty();
             let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
             $.ajax({
                url: BASE_URL + `/api/user/search?page=${page}&per_page=${itemsPerPage}`,
                data:{'search':search,'daerah_id':daerah_id},
                method: 'POST',
                success: function(response) {
                    list = response.data;
                    resultTotal(response.total);
                    listOptions(response.options);
                   
                    updateContent(response.data,response.options);
                    updatePagination(response.current_page, response.last_page);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
         }    
    });


     function resultTotal(total){
       $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
    }

     // Function to delete items
    function deleteItems(ids) {
        // Send the selected IDs for deletion using AJAX
        
        $.ajax({
            url:  BASE_URL +`/api/user/selected`,
            method: 'POST',
            data: { data: ids },
            success: function(response) {

                // Handle success (e.g., remove deleted items from the list)
                fetchData(page);
                $('#delete-selected').prop("disabled", true);
            },
            error: function(error) {
                console.error('Error deleting items:', error);
            }
        });
    }

    // Function to fetch data from the API
    function fetchData(page) {
           const content = $('#content');
           content.empty();
          
        let row = ``;
        row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
        content.append(row);

         if(daerah_id)
         {
            var url = BASE_URL + `/api/user/search?page=${page}&per_page=${itemsPerPage}`;
            var method = 'POST';
         }else{
           var url = BASE_URL+ `/api/user?page=${page}&per_page=${itemsPerPage}`;
           var method = 'GET';
         }  

        $.ajax({
            url: url,
            method: method,
            data:{'search':search,'daerah_id':daerah_id},
            success: function(response) {
                list = response.data;
                resultTotal(response.total);
                listOptions(response.options);
                updateContent(response.data,response.options);
                updatePagination(response.current_page, response.last_page);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Function to update the content area with data
    function updateContent(data,options) {
        const content = $('#content');
        const edited = options.find(o => o.action === 'edit');
        const deleted = options.find(o => o.action === 'delete');
        const checklist = options.find(o => o.action === 'checklist');
       
        // Clear previous data
        content.empty();
     if(data.length>0)
     {
        // Populate content with new data
        data.forEach(function(item, index) {
            let row = ``;
             row +=`<tr>`;

               if(item.deleted == true)
               {
                  if(checklist.checked == true)
                  {
                     row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
                  }
                  
               }else{
                  if(checklist.checked == true)
                  {
                  row +=`<td><input disabled  type="checkbox"></td></td>`;  
                  }
               }    
               
               row +=`<td class="padding-text-table">${item.number}</td>`;
               row +=`<td class="padding-text-table">${item.username}</td>`;
               row +=`<td class="padding-text-table">${item.name}</td>`;
               row +=`<td class="padding-text-table">${item.email}</td>`;
               row +=`<td class="padding-text-table">${item.phone}</td>`;
               row +=`<td class="padding-text-table">${item.status.status_convert}</td>`;
               row +=`<td>`; 
                row +=`<div class="btn-group pull-left list-menu-table">`;



                row +=`<button id="ForgotPassword" data-param_id="`+ item.email +`"  type="button" data-toggle="tooltip" data-placement="top" title="Kirim Forgot password"  class="btn btn-primary"><i class="fa fa-envelope-o" ></i></button>`;

                if(edited.checked == true)
                {
                    row +=`<button id="Edit" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}" type="button" data-toggle="tooltip" data-placement="top" title="Edit Data"  class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;

                    row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
                    row +=`<div id="FormEdit-${item.id}"></div>`;
                    row +=`</div>`;

                }

                if(item.deleted == true)
               {
                   
                 if(deleted.checked == true) 
                 {
                    row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`; 
                 } 
                  
                 
               }else{
                  if(deleted.checked == true) 
                  {

                    row +=`<button disabled  data-toggle="tooltip" title="Hapus Data"  type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;
                  }   

                   
               }

               if(item.status.status_db == 'Y')
               {

                  
                row +=`<button id="NonActive" data-param_id="`+ item.id +`"  type="button" data-toggle="tooltip" data-placement="top" title="Non Aktif Data"  class="btn btn-primary"><i class="fa fa-ban" ></i></button>`;

                row +=`</div>`;
                row +=`</td>`;
                row +=`</tr>`; 


               }else{
                 
                   row +=`<button id="Active" data-param_id="`+ item.id +`"  type="button" data-toggle="tooltip" data-placement="top" title="Aktif Data"  class="btn btn-primary"><i class="fa fa-check-square" ></i></button>`;

                  row +=`</div>`;
                  row +=`</td>`;
                  row +=`</tr>`; 


               }

            content.append(row);
        });

      }else{
            
                let row = ``;
                 row +=`<tr>`;
                 row +=`<td colspan="8" align="center">Data Kosong</td>`;
                 row +=`</tr>`;
                 content.append(row);

      }         

        $('.item-checkbox').on('click', function() {
         const checkedCount = $('.item-checkbox:checked').length;
         if(checkedCount ==true)
         {
           $('#delete-selected').prop("disabled", false);
         }else{
           $('#delete-selected').prop("disabled", true);
         }  
        });
        

        

        $( "#content" ).on( "click", "#Edit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id === id); 
            SelectRole(item);

            // Event handler when an item is selected
            $('.select-edit').on('select-edit:select', function(e) {
                var selectedOption = e.params.data;
                $('#daerah_id').val(selectedOption.id);
            });
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

                       row +=`<div class="modal-header">`;
                         row +=`<button type="button"  data-dismiss="modal" class="clear-input close" >&times;</button>`;
                         row +=`<h4 class="modal-title">Edit User</h4>`;
                       row +=`</div>`;

                       row +=`<form   id="FormSubmit-`+ item.id +`">`;
                            row +=`<div class="modal-body">`;

                                 row +=`<div id="role-alert-`+ item.id +`" class="form-group has-feedback">`;

                                     row +=`<label>Role </label>`;
                                   row +=`<select id="role-`+ item.id +`" class="selectpicker" name="role_id"></select>`;

                                   row +=`<span id="role-messages-`+ item.id +`" class="span-messages"></span>`;
                                 row +=`</div>`;
                               
                                row +=`<div class="form-group has-feedback" >`;
                                  row +=`<label>Username</label>`;
                                  row +=`<input type="text" class="form-control" name="username" placeholder="Username" value="`+ item.username +`" disabled>`;
                                row +=`</div>`;

                                 row +=`<div id="name-alert-`+ item.id +`" class="form-group has-feedback" >`;

                                  row +=`<label>Name</label>`;

                                  row +=`<input type="text" class="form-control" name="name" placeholder="Name" value="`+ item.name +`">
                                  <span id="name-messages-`+ item.id +`" class="span-messages"></span>`;

                                 row +=`</div>`;



                                 row +=`<div id="email-alert-`+ item.id +`" class="form-group has-feedback">`;

                                   row +=`<label>Email</label>`;

                                   row +=`<input type="email" class="form-control" name="email" placeholder="email" value="`+ item.email +`">`;

                                   row +=`<span id="email-messages-`+ item.id +`" class="span-messages"></span>`;

                                 row +=`</div>`;


                                 row +=`<div id="phone-alert-`+ item.id +`" class="form-group has-feedback">`;

                                   row +=`<label>Phone</label>`;

                                   row +=`<input type="text" class="form-control" name="phone" placeholder="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"  value="`+ item.phone +`">`;

                                   row +=`<span id="phone-messages-`+ item.id +`" class="span-messages"></span>`;

                                 row +=`</div>`;



                                 row +=`<div id="nip-alert-`+ item.id +`" class="form-group has-feedback">`;

                                   row +=`<label>NIP</label>`;

                                   row +=`<input type="text" class="form-control" name="nip" placeholder="NIP"  oninput="this.value = this.value.replace(/[^0-9.]/g, '')" value="`+ item.nip +`">`;

                                   row +=`<span id="nip-messages-`+ item.id +`" class="span-messages"></span>`;

                                 row +=`</div>`;


                                 row +=`<div id="leader-name-alert-`+ item.id +`" class="form-group has-feedback">`;

                                   row +=`<label>Penanggung Jawab</label>`;

                                   row +=`<input type="text" class="form-control" name="leader_name" placeholder="Penanggung Jawab " value="`+ item.leader_name +`">`;

                                   row +=`<span id="leader-name-messages-`+ item.id +`" class="span-messages"></span>`;

                                 row +=`</div>`;


                                 row +=`<div id="leader-nip-alert-`+ item.id +`" class="form-group has-feedback">`;

                                   row +=`<label>NIP Penanggung Jawab</label>`;

                                   row +=`<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"  class="form-control" name="leader_nip" placeholder="NIP Penanggung Jawab" value="`+ item.leader_nip +`">`;
                                    row +=`<span id="leader-nip-messages-`+ item.id +`" class="span-messages"></span>`;

                                 row +=`</div>`;


                                 row +=`<div id="daerah-alert-`+ item.id +`" class="form-group has-feedback">`;
                                
                                     
                                 
                                      row +=`<label id="text_label"></label>`;
                                
                                   row +=`<select id="daerah_id-`+ item.id +`" class="selectpicker form-control" data-live-search="true" name="daerah_id" ></select>`;

                                   row +=`<span id="daerah-messages-`+ item.id +`" class="span-messages"></span>`;
                                 row +=`</div>`;

                                 row +=`<div  class="form-group has-feedback">`;
                                  row +=`<label>Photo </label>`;
                                  row +=`<div  class="user-photo camera_upload">`;
                                    row +=`<img id="user-photo" width="130" src="`+ item.photo +`" alt="admin sidak">`;
                                    row +=`<i id="addPhotos" class="icon fa fa-camera"></i>`;
                                    row +=`<input id="AddFiles" type="file" name="upload_photo" style="display:none">`;
                                  row +=`</div>`;
                                row +=`</div>`;


                                  row +='<div id="password-alert" class="form-group has-feedback">';
                                    row +='<label>Password </label>';
                                    row +='<input id="password-add" type="password" class="form-control" name="password" placeholder="Password">';
                                    row +='<span id="password-messages" class="span-messages"></span>';
                                  row +='</div>';

                                  row +='<div id="password-confirmation-alert" class="form-group has-feedback">';
                                    row +='<label>Konfirmasi Password </label>';
                                    row +='<input id="password-confirmation-add" type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password">';
                                    row +='<span id="password-confirmation-messages" class="span-messages"></span>';
                                  row +='</div>';

                                


                            row +=`</div>`;

                            row +=`<div class="modal-footer">`;
                                row +=`<button type="button"  data-dismiss="modal" class="clear-input btn btn-default" >Tutup</button>`;

                                  row +=`<button id="update" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
                                    row +=`<button id="load-update" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
                            </div>`;
                            row +=`</div>`;


                        row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`;


          

            $('#FormEdit-'+ item.id).html(row);
           
           $("#close1").click(()=> {  
              DefaultNull(item.id);
           });

            $("#close2").click(()=> {  
              DefaultNull(item.id);
           });

          

            $("#addPhotos").click(()=> {
               $("#AddFiles").trigger("click");
            
            });

            $("#AddFiles").change((event)=> {     
            
              const files = event.target.files
              let filename = files[0].name
              const fileReader = new FileReader()
              fileReader.addEventListener('load', () => {

                if(files[0].name.toUpperCase().includes(".PNG"))
                {
                    photo = fileReader.result;
                    $('#user-photo').attr("src", photo);
                }else if(files[0].name.toUpperCase().includes(".JPEG")){
                    photo = fileReader.result;
                    $('#user-photo').attr("src", photo);
                }else if(files[0].name.toUpperCase().includes(".JPG")){
                    photo = fileReader.result;
                    $('#user-photo').attr("src", photo);
                }else{
                  Swal.fire({
                    icon: 'info',
                    title: 'Tipe file tidak diizinkan!',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
                  });  
                } 


               

                  
              })
              fileReader.readAsDataURL(files[0])

            });

            
            if(item.role_id =='admin' || item.role_id =='pusat')
            {
               $('#daerah-alert-'+ item.id).hide();
                
            }else{
               $('#daerah-alert-'+ item.id).show();
               if(item.role_id == 'province')
               {        
                    text_label = 'Provinsi';
                    SelectProvinsi(item,text_label)
                    $('#text_label').text(text_label);
                }else{
                    text_label = 'Kabupaten / Kota';
                    SelectKabupaten(item,text_label)
                    $('#text_label').text(text_label);
                }

            }   
            

            $('#role-'+ item.id).change(function() {
              var selectedText = $(this).find("option:selected").text();
                  
                if(selectedText =='Admin' || selectedText =='Pusat')
                {
                  $('#daerah-alert-'+ item.id).hide();
                }else{
                   $('#daerah-alert-'+ item.id).show();
                   if(selectedText =='Provinsi')
                   {
                      
                      text_label = 'Provinsi';
                      SelectProvinsi(item,text_label);
                      $('#text_label').text(text_label);
                    }else if(selectedText =='Kabupaten'){
                        
                       text_label = 'Kabupaten / Kota';
                      SelectKabupaten(item,text_label);
                      $('#text_label').text(text_label);
                    }

                }

                  
            });  

                // Fetch data using AJAX
              

            $( ".modal-content" ).on( "click", "#update", (e) => {
                  let id = e.currentTarget.dataset.param_id;
                  let find = list.find(o => o.id === id); 
          


                  var data = $("#FormSubmit-"+ id).serializeArray();
                  $("#update").hide();
                  $("#load-update").show();
                  var periode = $("#daerah_id-"+ id).val();
                  
                    
                  var form = {
                      
                      'role_id':data[0].value, 
                      'name':data[1].value,
                      'email':data[2].value,
                      'phone':data[3].value,
                      'nip':data[4].value,
                      'leader_name':data[5].value,
                      'leader_nip':data[6].value,
                      'password': data[7].value,
                      'password_confirmation': data[8].value,
                      'daerah_id':periode,
                      'photo':photo, 
                      'username':find.username,        
                  };



                    $.ajax({
                        type:"PUT",
                        url: BASE_URL+'/api/user/'+ id,
                        data:form,
                        cache: false,
                        dataType: "json",
                        success: (respons) =>{

                               Swal.fire({
                                    title: 'Sukses!',
                                    text: 'Berhasil Diupdate',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                    
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // User clicked "Yes, proceed!" button
                                        window.location.replace('/user');
                                    }
                                });

                               //
                        },
                        error: (respons)=>{
                            errors = respons.responseJSON;
                            SelectRole(find);
                             $("#update").show();
                             $("#load-update").hide();
 
                            if(errors.messages.name)
                            {
                                 $('#name-alert-'+id).addClass('has-error');
                                 $('#name-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
                            }else{
                                $('#name-alert-'+id).removeClass('has-error');
                                $('#name-messages-'+id).removeClass('help-block').html('');
                            }

                             if(errors.messages.email)
                            {
                                 $('#email-alert-'+id).addClass('has-error');
                                 $('#email-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.email +'</strong>');
                            }else{
                                $('#email-alert-'+id).removeClass('has-error');
                                $('#email-messages-'+id).removeClass('help-block').html('');
                            }  

                            if(errors.messages.phone)
                            {
                                 $('#phone-alert-'+id).addClass('has-error');
                                 $('#phone-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.phone +'</strong>');
                            }else{
                                $('#phone-alert-'+id).removeClass('has-error');
                                $('#phone-messages-'+id).removeClass('help-block').html('');
                            }

                            if(errors.messages.nip)
                            {
                                 $('#nip-alert-'+id).addClass('has-error');
                                 $('#nip-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.nip +'</strong>');
                            }else{
                                $('#nip-alert-'+id).removeClass('has-error');
                                $('#nip-messages-'+id).removeClass('help-block').html('');
                            }  

                            if(errors.messages.daerah_id)
                            {
                                 $('#daerah-alert-'+id).addClass('has-error');
                                 $('#daerah-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.daerah_id +'</strong>');
                            }else{
                                $('#daerah-alert-'+id).removeClass('has-error');
                                $('#daerah-messages-'+id).removeClass('help-block').html('');
                            } 

                              if(errors.messages.role_id)
                            {
                                 $('#role-'+id).addClass('has-error');
                                 $('#role-'+id).addClass('help-block').html('<strong>'+ errors.messages.role_id +'</strong>');
                            }else{
                                $('#role-'+id).removeClass('has-error');
                                $('#role-'+id).removeClass('help-block').html('');
                            }   

                            if(errors.messages.leader_name)
                            {
                                 $('#leader-name-alert-'+id).addClass('has-error');
                                 $('#leader-name-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.leader_name +'</strong>');
                            }else{
                                $('#leader-name-alert-'+id).removeClass('has-error');
                                $('#leader-name-messages-'+id).removeClass('help-block').html('');
                            } 

                             if(errors.messages.leader_nip)
                            {
                                 $('#leader-nip-alert-'+id).addClass('has-error');
                                 $('#leader-nip-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.leader_nip +'</strong>');
                            }else{
                                $('#leader-nip-alert-'+id).removeClass('has-error');
                                $('#leader-nip-messages-'+id).removeClass('help-block').html('');
                            }  

                            if (errors.messages.password) {
                                $('#password-alert').addClass('has-error');
                                $('#password-messages').addClass('help-block').html('<strong>' + errors.messages.password + '</strong>');
                              } else {
                                $('#password-alert').removeClass('has-error');
                                $('#password-messages').removeClass('help-block').html('');
                              }

                              if (errors.messages.password_confirmation) {
                                $('#password-confirmation-alert').addClass('has-error');
                                $('#password-confirmation-messages').addClass('help-block').html('<strong>' + errors.messages.password_confirmation + '</strong>');
                              } else {
                                $('#password-confirmation-alert').removeClass('has-error');
                                $('#password-confirmation-messages').removeClass('help-block').html('');
                              }

                            
                        }
                      });
 
                
        });  
            
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
                    // Perform the delete action here, e.g., using an AJAX request
                    // You can use the itemId to identify the item to be deleted
                    deleteItem(id);
                    
                    Swal.fire(
                      'Deleted!',
                      'Data berhasil dihapus.',
                      'success'
                    );
                  }
                });

            
        }); 


        $( "#content" ).on( "click", "#NonActive", (e) => {
            let id = e.currentTarget.dataset.param_id;


            Swal.fire({
                  title: 'Apakah anda yakin non aktifkan?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Ya'
                }).then((result) => {
                  if (result.isConfirmed) {
                
                    StatusItem(id,'false');
                    
                    Swal.fire(
                      'NonAktif!',
                      'Data berhasil.',
                      'success'
                    );
                  }
                });

            
        }); 

        $( "#content" ).on( "click", "#Active", (e) => {
            let id = e.currentTarget.dataset.param_id;


            Swal.fire({
                  title: 'Apakah anda yakin aktifkan?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Ya'
                }).then((result) => {
                  if (result.isConfirmed) {
                
                    StatusItem(id,'true');
                    
                    Swal.fire(
                      'Aktifkan!',
                      'Data berhasil.',
                      'success'
                    );
                  }
                });

            
        }); 


          $( "#content" ).on( "click", "#ForgotPassword", (e) => {
            let email = e.currentTarget.dataset.param_id;

              $.ajax({
                    type: "POST",
                    url: BASE_URL + '/api/user/sendmail',
                    data: {'email':email},
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                        
                         Swal.fire({
                            title: 'Sukses!',
                            text: 'Berhasil mengirim Email ',
                            icon: 'success',
                            confirmButtonText: 'OK'

                          }).then((result) => {
                            if (result.isConfirmed) {
                              // User clicked "Yes, proceed!" button
                              window.location.replace('/user');
                            }
                          });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
           

            
        }); 
           
       
        
    }

    function DefaultNull(id){

           $('#daerah-alert-add').hide();
           $("input").val(null);
           $('#role-'+ id).selectpicker('val', 'null');
           $('#daerah_id-'+ id).selectpicker('val', 'null');          
           $('#modal-edit-'+ id).modal('toggle');

        }

    function SelectProvinsi(item,text_label){
           
             $.ajax({
                url: BASE_URL +'/api/select-province',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                  var select =  $('#daerah_id-'+item.id)

                 // Clear existing options
                 //select.empty();

                  // Populate options from the received data
                  $.each(data, function(index, option) {
                    select.append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                  });

                 // Set a specific option as selected
                   var selectedValue = item.daerah_id;
                   select.val(selectedValue);
                  // Refresh the SelectPicker
                  select.selectpicker('refresh');

                },
                error: function() {
                  console.error('Failed to fetch data.');
                }
              }); 

    }

    function SelectKabupaten(item,text_label){
       
        $.ajax({
                url: BASE_URL +'/api/select-kabupaten',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                  var select =  $('#daerah_id-'+item.id)

                 // Clear existing options
                 //select.empty();

                  // Populate options from the received data
                  $.each(data, function(index, option) {
                    select.append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                  });

                 // Set a specific option as selected
                   var selectedValue = item.daerah_id;
                   select.val(selectedValue);
                  // Refresh the SelectPicker
                  select.selectpicker('refresh');

                },
                error: function() {
                  console.error('Failed to fetch data.');
                }
              }); 
          

    }

    function SelectRole(item){

        $.ajax({
                url: BASE_URL +'/api/select-role',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                  var select =  $('#role-'+item.id)

                 // Clear existing options
                 //select.empty();

                  // Populate options from the received data
                  $.each(data, function(index, option) {
                    select.append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                  });

                 // Set a specific option as selected
                   var selectedValue = item.role_id;
                   select.val(selectedValue);
                  // Refresh the SelectPicker
                  select.selectpicker('refresh');

                },
                error: function() {
                  console.error('Failed to fetch data.');
                }
              });

    }

    function deleteItem(id){

        $.ajax({
            url:  BASE_URL +`/api/user/`+ id,
            method: 'DELETE',
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
                fetchData(page);
            },
            error: function(error) {
                console.error('Error deleting items:', error);
            }
        });

    }


    function StatusItem(id,status){

        $.ajax({
            url:  BASE_URL +`/api/user/status`,
            method: 'POST',
            data:{'id':id,'status':status},
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
               fetchData(page);
            },
            error: function(error) {
                console.error('Error post items:', error);
            }
        });

    }

    function exportData(data)
    {
        
         const content = $('#exportView');
        
         content.empty();
         if(data.length>0)
         {
            // Populate content with new data
            data.forEach(function(item, index) {
                let row = ``;
                 row +=`<tr>`;

                   row +=`<td class="padding-text-table">${item.number}</td>`;
                   row +=`<td class="padding-text-table">${item.username}</td>`;
                   row +=`<td class="padding-text-table">${item.name}</td>`;
                   row +=`<td class="padding-text-table">${item.email}</td>`;
                   row +=`<td class="padding-text-table">${item.phone}</td>`;
                   row +=`<td class="padding-text-table">${item.nip}</td>`;
                   row +=`<td class="padding-text-table">${item.leader_name}</td>`;
                   row +=`<td class="padding-text-table">${item.leader_nip}</td>`;
                   row +=`<td class="padding-text-table">${item.daerah_name}</td>`;
                   row +=`<td class="padding-text-table">${item.role}</td>`;
                   row +=`<td class="padding-text-table">${item.status}</td>`;
                   row +=`<td class="padding-text-table">${item.created_at_format}</td>`;
                 row +=`</tr>`;

               content.append(row);
             });     

         }     

         ExportExel();   

    }

     function ExportExel()
    {
        var dt = new Date();
       var time =  dt.getDate() + "-"
                + (dt.getMonth()+1)  + "-" 
                + dt.getFullYear();

      var table = document.getElementById("myTable");
      var ws = XLSX.utils.table_to_sheet(table);
      var wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
      XLSX.writeFile(wb, "Repot-data-user-"+ time +".xlsx");

    }




    function listOptions(data){
        
       data.forEach(function(item, index) 
       {
           if(item.action =='add')
           {
               if(item.checked ==true)
               {
                   $('#ShowAdd').show();
               }else{
                  $('#ShowAdd').hide();
               }    
           }
               
           if(item.action =='export')
           {
               if(item.checked ==true)
               {
                   $('#ShowExport').show();
               }else{
                  $('#ShowExport').hide();
               }    
           }     


            if(item.action =='checklist')
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

 
    // Function to update pagination controls
    function updatePagination(currentPage, totalPages) {
        const pagination = $('#pagination');

        // Clear previous pagination
        pagination.empty();

        // Calculate start and end page for visible links
        let startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
        let endPage = Math.min(totalPages, startPage + visiblePages - 1);

        //Create "First Page" button
        if (currentPage > 1) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="1">«</button></li>`);

        }else{
             pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable">«</button></li>`);
        }

         // Create "Back" button
        if (currentPage > 1) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage - 1}">‹</button></li>`);
        }else{
            //back disable
            pagination.append(`<li class="pagination-item "><button class="pagination-link pagination-disable" >‹</button></li>`);
        }

        // Create pagination links
        for (let i = startPage; i <= endPage; i++) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link${i === currentPage ? ' pagination-link--active' : ''}" data-page="${i}">${i}</button></li>`);
        }

          // Create "Next" button
        if (currentPage < totalPages) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage + 1}">›</button></li>`);
        }else{
            pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >›</button></li>`);
        }

         // Create "Last Page" button
        if (currentPage < totalPages) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${totalPages}">»</button></li>`);

        }else{
              pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >»</button></li>`);
        }



        // Add click event to pagination links
        pagination.find('.page-link').on('click', function() {
            currentPage = parseInt($(this).data('page'));
             const content = $('#content');
             content.empty();
            fetchData(currentPage);
        });
    }
    localStorage.removeItem('sidebar_active');
    // Initial data fetch
    fetchData(currentPage);
});
     </script>

@stop
