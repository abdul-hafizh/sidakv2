@extends('template/sidakv2/layout.app')
@section('content')


<div class="content">
    <div class="box box-primary">

            <div class="box-body">
                
                <div class="row" >
               
                       <div class="form-group col-sm-12" >
                             <label>Judul  :</label>
                             <p>{{ $result->title }}</p>
                            
                        </div>


                        <div class="form-group col-sm-12" >
                             <label>Tentang  :</label>
                             <p>{{ $result->about }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Kontak  :</label>
                             <p>{{ $result->contact }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Alamat  :</label>
                             <p>{{ $result->address }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Facebook  :</label>
                             <p>{{ $result->facebook }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Instagram  :</label>
                             <p>{{ $result->instagram }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Twitter  :</label>
                             <p>{{ $result->twitter }}</p>
                        </div>

                        <div class="form-group col-sm-12" >
                             <label>Logo  :</label>
                           
                            
                             <div class="image-preview" >
                                <img class="preview mt15" src="{{ $result->logo_lg }}" width="100">
                             </div>
                            
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Icon  :</label>
                           
                            
                             <div class="image-preview-icon" >
                                <img class="preview mt15" src="{{ $result->logo_sm }}" >
                             </div>
                            
                        </div>

                        

                        <div class="form-group col-sm-12">
                          
                             <button class="btn btn-primary">Edit</button>
                          
                        </div>
                </div>

               
                

               
            </div>
        </div>
  
    
</div>

@stop