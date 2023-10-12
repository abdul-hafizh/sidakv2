@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div  class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
        <div class="pull-right width-25">
            <div class="input-group input-group-sm border-radius-20">
				<input type="text" id="search-input" placeholder="Cari" class="form-control height-35 border-radius-left">
				<span class="input-group-btn">
				<button id="Search" type="button" class="btn btn-search btn-flat height-35 border-radius-right"><i class="fa fa-search"></i></button>
				</span>
			</div>
        </div> 	
    </div> 	

	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
			
			
<!-- 
			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button"  id="refresh" class="btn btn-primary border-radius-10">
					 Refresh
				</button>
			</div> -->

			<div id="ShowChecklist" style="display:none;"  class="pull-left padding-9-0 margin-left-button">
                <button type="button"  id="Back" class="btn bg-navy border-radius-10">
                  <i class="fa fa-undo" aria-hidden="true"></i> Kembali 
                </button>
            </div>

            <div  class="pull-left padding-9-0 margin-left-button" >
                <button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>


			<div id="ShowAdd" style="display:none;"  class="pull-left padding-9-0">
                <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
				 Tambah
				</button> 
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
						
							<th id="ShowChecklistAll" style="display:none;"  ><input id="select-all" class="span-title" type="checkbox"></th>
                            <th><div  id="ShowChecklistAll" style="display:none;"   class="split-table"></div><span class="span-title">No</span>  </th>

							<th><div class="split-table"></div><span class="span-title">Topik</span></th>
							<th><div class="split-table"></div><span class="span-title">Total Komentar</span></th>
						
							<th ><div class="split-table"></div><span class="span-title"> Aksi </span></th>
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
     @include('template/sidakv2/forum.topicAdd')  
     @include('template/sidakv2/forum.exportTopik') 
<script type="text/javascript">

 $(document).ready(function() {

 	
    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;
    var url = window.location.href; // Get the current URL
    var segments = url.split('/');   // Split the URL by '/'
    var topic = segments[4]; // Index 4 corresponds to the second segment
    

    
     // Refresh selected button
    $('#refresh').on('click', function() {
    	
        fetchData(page);
        $('#search-input').val('');
    });

     $('#Back').on('click', function() {
    	  window.location.replace('/forum/'); 
       
    });


    $("#ExportButton").click(function() {
        $.ajax({
            url: BASE_URL+ `/api/topic/`+ topic +`?page=${page}&per_page=all`,	
            method: 'GET',
            success: function(response) {
            	
            	 exportData(response.data);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });

    
    $('#Search').click( () => {
 		 let search = $('#search-input').val();
 		 
 		 if(search)
 		 { 	
	 		 const content = $('#content');
        	 content.empty();
    	 	 let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
	         $.ajax({
	            url: BASE_URL + `/api/topic/search?page=${page}&per_page=${itemsPerPage}`,
	            data:{'search':search},
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

    // Function to fetch data from the API
    function fetchData(page) {
    	  
		const content = $('#content');
		content.empty();

		let row = ``;
		row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
		content.append(row);

		

        $.ajax({
            url: BASE_URL+ `/api/topic/`+ topic +`?page=${page}&per_page=${itemsPerPage}`,
            method: 'GET',
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

      

        // Clear previous data
        content.empty();
        if(data.length>0)
        { 	
	        // Populate content with new data
	        data.forEach(function(item, index) {
	           	let row = ``;
	             row +=`<tr>`;
	              options.forEach(function(opt, arr) 
	              {
	                 if(opt.action == 'delete')
	                 {
	                    if(opt.checked == true)
	                    {
	                        row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
	                    }
	                 }       
	              });
	               row +=`<td>${item.number}</td>`;
	               row +=`<td>${item.name}</td>`;
	               row +=`<td>${item.total_messsage}</td>`;
	               
	               row +=`<td>`; 
	                 row +=`<div class="btn-group">`;
	                row +=`<button id="Replay"  data-param_id="${item.id}" data-toggle="modal" data-target="#modal-edit-${item.id}" data-toggle="tooltip" data-placement="top" title="Lihat Komentar" type="button" class="btn btn-primary"><i class="fa fa-eye" ></i></button>`;
	            
	               

	                  options.forEach(function(opt, arr) 
		            {
	                    if(opt.action == 'delete')
                        {
                           if(opt.checked == true)
                           {

                           	 if(item.access == 'admin' || item.access == 'pusat')
	                         {  
                             
                            
	                         row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;

	                         }

                           } 
                        } 

                    });


	                  row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
	                	row +=`<div id="FormEdit-${item.id}"></div>`;
	                  row +=`</div">`;
	               

	                row +=`</div>`;
	                row +=`</td>`;
	              row +=`</tr>`; 

	            content.append(row);

	        });
	    }else{
            
             	let row = ``;
	             row +=`<tr>`;
	             row +=`<td colspan="5" align="center">Data Kosong</td>`;
                 row +=`</tr>`;
                 content.append(row);

	    }    

        
   		//list chat
         $( "#content" ).on( "click", "#Replay", (e) => {
            let id = e.currentTarget.dataset.param_id;
            let item = list.find(o => o.id === id)
         
            getlistComment(item);
            
            
        });

        $( "#content" ).on( "click", "#Destroy", (e) => {
	        let id = e.currentTarget.dataset.param_id;
            //delete topik

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


        
       
        
    }

     function deleteItem(id){

		$.ajax({
		    url:  BASE_URL +`/api/topic/delete-all/`+ id,
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

    function getlistComment(item){

           $.ajax({
			    url:  BASE_URL +`/api/topic/list-replay/`+ item.id,
			    method: 'GET',
			    success: function(response) {
			    	
			        viewComment(response,item);
			        
			    },
			    error: function(error) {
			        console.error('Error deleting items:', error);
			    }
			});
         

    }

     function viewComment(data,item){
       
       let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content pull-left full">`;

				       row +=`<div class="modal-header pull-left full">`;
				         row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Forum `+ item.category +` </h4>`;
				       row +=`</div>`;

				       row +=`<form  id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="pull-left full modal-body ">`;

					               row +=`<div id="succes"></div>`;    
                                   row +=`<div  class="pull-left full form-group ">`;
		                           row +=`<label >Topik : `+ item.name +`</label>`;
		                           row +=`</div>`;	


		                           row +=`<div class="pull-left full form-group">`;
                                      row +=`<div id="replayNew" ></div>`;
                                      
                                      row +=`<div id="slimScrollDiv">`;
                                      data.forEach(function(items, index) {
			                                  
												row +=`<div id="list-${index}" class="form-group pull-left full border-list">`;		
													row +=`<div class="col-sm-2">`;
													row +=`<img class="chat-img" src="${items.photo}" alt="${items.username}" class="offline">`;	
				                                           
				                                    row +=`</div>`;	
													row +=`<div class="margin-top-7 col-sm-8">`;
			                                               row +=`<input class="text-username" disabled type="text" value="${items.username}">`;
																row +=`<textarea id="comment-edit-`+ items.id +`" disabled class="form-control textarea-fixed-replay text-message resize-hide">${items.messages}</textarea>`;
													row +=`</div>`;	
                                                     
                                                     row +=`<div id="divclose-`+ items.id +`" style="display:none;" class="col-sm-2 padding-none ">`;

													 row +=`<button  id="Close-Edit" data-param_index="`+ index +`" data-param_id="`+ items.id +`"   type="button" class="pull-right btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>`;
                                                    row +=`</div>`;	

                                                 row +=`<div id="btn-update-`+ items.id +`" style="display:none;" class="pull-left full"  >`;

                                                 row +=`<div class="pull-left col-sm-2"></div>`;
                                              
                                                 row +=`<div class="pull-left col-sm-8 padding-top-bottom-com">`;
                                                    row +=`<button id="update-topic" data-param_id="`+ items.id +`" type="button" class="update-topic-`+ items.id +` pull-right btn btn-primary" >Update</button>`;
                                                 row +=`</div>`;

                                                row +=`</div>`;		

													row +=`<div id="option-`+ items.id +`" class="margin-top-32 col-sm-2 btn-group btn-group-forum padding-none ">`;
													 
                                                 if(items.action == true)
                                                {
													   row +=`<button id="Edit" data-param_index="`+ index +`" data-param_id="`+ items.id +`"   type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>`;
			                                         row +=`<button id="deleted" data-param_index="`+ index +`" data-param_id="`+ items.id +`"  type="button" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
			                                        row +=`</div>`;
												}	

												row +=`</div>`;
							           
			                            });
                                    row +=`</div>`;
                                   row +=`</div>`;

                                      row +=`<div class="form-group has-feedback pull-left full" >`;
						              row +=`<label>Komentar :</label>`;
						              row +=`<textarea id="comment" class="form-control textarea-fixed-replay" placeholder="Komentar" name="messages"></textarea>`;
						              row +=`<span id="messages-messages"></span>`;
						              row +=`</div>`;
                         
                            row +=`</div>`;
    
                            row +=`<div class="pull-left full modal-footer">`;
						        row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="kirim" disabled data-param_id="`+ item.id +`" type="button" class="btn btn-default">Kirim</button>`;
						            row +=`<button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button></div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ item.id).html(row); 
        
           $( ".modal-content" ).on( "click", ".clear-input", (e) => {
                location.reload();
            }); 	
            
              
             $('#comment').on('input', function() {
                 $('#kirim').removeClass('btn-default').addClass('btn-primary');	
		         var charCount = $(this).val().length;
		         if(charCount >0)
		         {
		         	$('#kirim').prop("disabled", false);
		         	$('#kirim').removeClass('btn-default').addClass('btn-primary');	
		         }else{
		         	$('#kirim').prop("disabled", true);
		         	$('#kirim').removeClass('btn-primary').addClass('btn-default');
		         } 
		        
		    });



            $( ".modal-content" ).on( "click", "#Edit", (e) => {
		          let id = e.currentTarget.dataset.param_id; 
		          let item = data.find(o => o.id === id)

		          $.ajax({
		            url: BASE_URL+ `/api/topic/comment/`+ id +``,
		            method: 'GET',
		            success: function(response) {

		                 $('#comment-edit-'+ item.id).val(response.messages).prop("disabled", false).removeClass('text-message');
		                 $('.update-topic-'+ item.id).prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
				          $('#divclose-'+ item.id).show();
		                  $('#btn-update-'+ item.id).show();
				          $('#option-'+ item.id).hide();
		            },
		            error: function(error) {
		                console.error('Error fetching data:', error);
		            }
		        });

                   $('#comment-edit-'+ item.id).on('input', function() {
		                $('.update-topic-'+ item.id).removeClass('btn-default').addClass('btn-primary');	
				         var charCount = $(this).val().length;
				         if(charCount >0)
				         {
				         	$('.update-topic-'+ item.id).prop("disabled", false);
				         	$('.update-topic-'+ item.id).removeClass('btn-default').addClass('btn-primary');	
				         }else{
				         	$('.update-topic-'+ item.id).prop("disabled", true);
				         	$('.update-topic-'+ item.id).removeClass('btn-primary').addClass('btn-default');
				         } 
				        
				    });
		        
		
              });

             $( ".modal-content" ).on( "click", "#Close-Edit", (e) => {
		          let id = e.currentTarget.dataset.param_id; 
		          let item = data.find(o => o.id === id)

		        
		          $('#comment-edit-'+ item.id).val(item.messages).prop("disabled", true).addClass('text-message');
		          $('#divclose-'+ item.id).hide();
		          $('#btn-update-'+ item.id).hide();
		          $('#option-'+ item.id).show();
		         
  
              });

            $( ".modal-content" ).on( "click", "#update-topic", (e) => {
		           let id = e.currentTarget.dataset.param_id; 
		           let item = data.find(o => o.id === id)
		          
                   var comment = $('#comment-edit-'+ item.id).val();
		           var form = {
			        	'comment':comment,
			        	'topic_id':item.id
			        };

		          $.ajax({
				    url:  BASE_URL +`/api/topic/update-replay/`+ id,
				    method: 'PUT',
				    data:form,
				    success: function(response) {
				        
				           

		                    var al = '';
		                    al +=`<div class="alert alert-success alert-dismissible">`;
								al +=`<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>`;
								al +=`<i class="icon fa fa-check"></i>`;
								al +=`Sukses update topic`;
							al +=`</div>`;
							$('#succes').append(al);

							       $('#comment-edit-'+ item.id).val(comment).prop("disabled", true).addClass('text-message');
						          $('#divclose-'+ item.id).hide();
						          $('#btn-update-'+ item.id).hide();
						          $('#option-'+ item.id).show();

					
						    setTimeout(function() {
						      $('#succes').html('');
						    
						    }, 3000); // 3000 milliseconds (3 seconds)	

				    },
				    error: function(error) {
				        console.error('Error deleting items:', error);
				    }
				});
		          
		
              }); 

            $( ".modal-content" ).on( "click", "#deleted", (e) => {
		          let id = e.currentTarget.dataset.param_id; 
		          let index = e.currentTarget.dataset.param_index; 

                $.ajax({
				    url:  BASE_URL +`/api/topic/delete-replay/`+ id,
				    method: 'DELETE',
				    success: function(response) {
				        
				         data.splice(index, 1);
		                  $('#list-'+index).remove();

		                    var al = '';
		                    al +=`<div class="alert alert-success alert-dismissible">`;
								al +=`<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>`;
								al +=`<i class="icon fa fa-check"></i>`;
								al +=`Sukses menghapus topic`;
							al +=`</div>`;
							$('#succes').append(al);

					
						    setTimeout(function() {
						      $('#succes').html('');
						     
						    }, 3000); // 3000 milliseconds (3 seconds)	

				    },
				    error: function(error) {
				        console.error('Error deleting items:', error);
				    }
				});



		         		


             }); 


                $( ".modal-content" ).on( "click", "#kirim", (e) => {
		          let id = e.currentTarget.dataset.param_id;
		          const item = list.find(o => o.id === id);

		          var data = $("#FormSubmit-"+ item.id).serializeArray();
	             
	              
			        var form = {
			        	'comment':data[0].value,
			        	'topic_id':item.id
			        };



					$.ajax({
			            type:"POST",
			            url: BASE_URL+'/api/topic/comment',
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{



			               $('#comment').val('');

       //                      var row = '';
       //                      row +=`<div class="form-group pull-left full border-list">`;
			    //         	row +=`<div class="col-sm-2">`;
							// row +=`<img class="chat-img" src="`+respons.data.photo+`" alt="`+respons.data.username+`" class="offline">`;	
	                                           
       //                      row +=`</div>`;	
							// row +=`<div class="margin-top-7 col-sm-10">`;
       //                             row +=`<input class="text-username" disabled type="text" value="`+respons.data.username+`">`;
							// 			row +=`<textarea disabled class="form-control textarea-fixed-replay text-message resize-hide">`+respons.data.messages+`</textarea>`;
							// row +=`</div>`;		
			    //             row +=`</div>`;	   
       //                    $('#replayNew').append(row);

                            var row = '';
                              row +=`<div class="form-group pull-left full text-center loading-position"> Loading ... </div>`;  
                               $('#replayNew').append(row);
                          
                          var al = '';
                           al +=`<div class="alert alert-success alert-dismissible">`;
								al +=`<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>`;
								al +=`<i class="icon fa fa-check"></i>`;
								al +=`Sukses mengirim kendala`;
							al +=`</div>`;
							$('#succes').append(al);

							$('#kirim').prop("disabled", true);
		         	        $('#kirim').removeClass('btn-primary').addClass('btn-default');

							setTimeout(function() {
						       $('#succes').html('');
						       $('#replayNew').remove();
						        getlistComment(item) ;
						    }, 3000); // 3000 milliseconds (3 seconds)
			                   
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                

			                

			                
			            }
			          });
                
		    });    

          $('#slimScrollDiv').slimScroll({
            height: '200px',
            railVisible: true,
            alwaysVisible: true,
            railOpacity: 0.4
        });

    }

    function SendData(form,id){
          if(form.status =='sent')
	      {
	        var status = 'Terkirim';
	      }else{
	        var status = 'Diupdate';
	      }  
    	 $.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/topic/'+ id,
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{
			                   Swal.fire({
			                        title: 'Sukses!',
			                        text: 'Berhasil '+ status,
			                        icon: 'success',
			                        confirmButtonText: 'OK'
			                        
			                    }).then((result) => {
			                        if (result.isConfirmed) {
			                            // User clicked "Yes, proceed!" button
			                            window.location.replace('/topic');
			                        }
			                    });

			                   //
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                $("#update").show();
			                $("#kirim").show();
			                $("#load-simpan").hide();
                             
                             if(errors.messages.permasalahan)
			                {
			                     $('#permasalahan-alert-'+id).addClass('has-error');
			                     $('#permasalahan-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.permasalahan +'</strong>');
			                }else{
			                    $('#permasalahan-alert-'+id).removeClass('has-error');
			                    $('#permasalahan-messages-'+id).removeClass('help-block').html('');
			                }

			                if(errors.messages.messages)
			                {
			                     $('#messages-alert-'+id).addClass('has-error');
			                     $('#messages-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.messages +'</strong>');
			                }else{
			                    $('#messages-alert-'+id).removeClass('has-error');
			                    $('#messages-messages-'+id).removeClass('help-block').html('');
			                }

			               
 
			                
			            }
		 });

    }

    function resultTotal(total){
       $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
    }

    
    function exportData(data){
          
          const content = $('#exportView');
        
         content.empty();
         if(data.length>0)
         {
            // Populate content with new data
            data.forEach(function(item, index) {
                let row = ``;
                 row +=`<tr>`;

                   row +=`<td class="padding-text-table">${item.number}</td>`;
                   row +=`<td class="padding-text-table">${item.name}</td>`;
                   row +=`<td class="padding-text-table">${item.total_messsage}</td>`;
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
       XLSX.writeFile(wb, "Repot-data-topik-"+ time +".xlsx");

         

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




            if(item.action =='delete')
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
            fetchData(currentPage);
        });
    }

    // Initial data fetch
    fetchData(currentPage);
});
     </script>

@stop

