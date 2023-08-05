@extends('template/sidakv2/layout.app')
@section('content')

<div class="content">
        <div class="row in-content">
        <form method="post" action="{{ route('perencanaan.store') }}">
            @csrf
            <section class="col-lg-12 connectedSortable ui-sortable ">
                <div class="box box-solid box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pengawasan</h3>
                      </div>
                    <div class="box-body" >                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>1. Pengawasan Penanaman Modal :</label>     
                            </div> 

                            <div class="form-group col-sm-12" >
                                <label>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha :</label>
                            </div>

                            <div class="form-group col-sm-3">
                                 <label>Target :</label>
                                 <input name="pengawas_analisa_target" type="number" class="form-control" placeholder="Target">
                                 @if ($errors->has('pengawas_analisa_target'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('pengawas_analisa_target') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-3">
                                 <label>Satuan :</label>
                                 <input name="pengawas_analisa_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-3">
                                 <label>Pagu :</label>
                                 <input name="pengawas_analisa_pagu" type="number" class="form-control" placeholder="Pagu">
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>



                            <div class="form-group col-sm-12" >
                                <label>B. Inspeksi Lapangan :</label>
                            </div>

                            <div class="form-group col-sm-3">
                                 <label> Target :</label>
                                 <input name="pengawas_inspeksi_target" type="number" class="form-control" placeholder="Target">
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-3">
                                 <label>Satuan :</label>
                                 <input name="pengawas_inspeksi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-3">
                                 <label>Pagu :</label>
                                 <input name="pengawas_inspeksi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-12" >
                                <label>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha :</label>
                            </div>

                            <div class="form-group col-sm-3">
                                 <label>Target :</label>
                                 <input name="pengawas_evaluasi_target" type="number" class="form-control" placeholder="Target">
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-3">
                                 <label>Satuan :</label>
                                 <input name="pengawas_evaluasi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group col-sm-3">
                              <label>Pagu :</label>
                              <input name="pengawas_evaluasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 @if ($errors->has('username'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                            </div>
                            
                            
                            <div class="form-group col-sm-12">
                              <button type="submit" class="btn btn-primary btn-flat border-radius-20">Simpan</button>
                            </div>    

                        </div>    
                    </div>   
                </div>
              </section>
            </form>
            </div>
          </div>

@stop