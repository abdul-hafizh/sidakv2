<?php

namespace App\Http\Request\Validation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationPromosi
{
   public static function validation($request){
        $err = array(); 
        
        $fields = [

         'periode_id' => 'Periode',
         'tgl_awal_peluang' => 'Tanggal Awal Peluang',
         'tgl_ahir_peluang' => 'Tanggal Ahir Peluang',
         'budget_peluang' =>   'Budget Peluang',
         'keterangan_peluang' => 'Keterangan Peluang',

         'tgl_awal_storyline' => 'Tanggal Awal Storyline',
         'tgl_ahir_storyline' => 'Tanggal Ahir Storyline',
         'budget_storyline' => 'Budget Storyline',
         'keterangan_storyline' =>'Keterangan Storyline',

         'tgl_awal_storyboard' => 'Tanggal Awal Storyboard',
         'tgl_ahir_storyboard' => 'Tanggal Ahir Storyboard',
         'budget_storyboard' => 'Budget Storyboard',
         'keterangan_storyboard' => 'Keterangan Storyboard',

         'tgl_awal_lokasi' => 'Tanggal Awal Lokasi',
         'tgl_ahir_lokasi' => 'Tanggal Ahir Lokasi',
         'budget_lokasi' => 'Budget Lokasi',
         'keterangan_lokasi' => 'Keterangan Lokasi',

         'tgl_awal_talent' => 'Tanggal Awal Talent',
         'tgl_ahir_talent' => 'Tanggal Ahir Talent',
         'budget_talent' => 'Budget Talent',
         'keterangan_talent' => 'Keterangan Talent',

         'tgl_awal_testimoni' =>'Tanggal Awal Testimoni',
         'tgl_ahir_testimoni' => 'Tanggal Ahir Testimoni',
         'budget_testimoni' => 'Budget Testimoni',
         'keterangan_testimoni' => 'Keterangan Testimoni',

         'tgl_awal_audio' => 'Tanggal Awal Audio',
         'tgl_ahir_audio' => 'Tanggal Ahir Audio',
         'budget_audio' => 'Budget Audio',
         'keterangan_audio' => 'Keterangan Audio',

         'tgl_awal_editing' => 'Tanggal Awal Editing',
         'tgl_ahir_editing' => 'Tanggal Ahir Editing',
         'budget_editing' => 'Budget Editing',
         'keterangan_editing' => 'Keterangan Editing',

         'tgl_awal_gambar' => 'Tanggal Awal Gambar',
         'tgl_ahir_gambar' => 'Tanggal Ahir Gambar',
         'budget_gambar' => 'Budget Gambar',
         'keterangan_gambar' => 'Keterangan Gambar',

         'tgl_awal_video' => 'Tanggal Awal Video',
         'tgl_ahir_video' => 'Tanggal Ahir Video',
         'budget_video' => 'Budget Video',
         'keterangan_video' => 'Keterangan Video',


         'tgl_awal_editvideo' => 'Tanggal Awal Edit Video',
         'tgl_ahir_editvideo' =>'Tanggal Ahir Edit Video',
         'budget_editvideo' => 'Budget Edit Video',
         'keterangan_editvideo' => 'Keterangan Edit Video',

         'tgl_awal_grafik' => 'Tanggal Awal Grafik',
         'tgl_ahir_grafik' => 'Tanggal Ahir Grafik',
         'budget_grafik' => 'Budget Grafik',
         'keterangan_grafik' => 'Keterangan Grafik',

         'tgl_awal_mixing' => 'Tanggal Awal Mixing',
         'tgl_ahir_mixing' => 'Tanggal Ahir Mixing',
         'budget_mixing' => 'Budget Mixing',
         'keterangan_mixing' => 'Keterangan Mixing',


         'tgl_awal_voice' => 'Tanggal Awal Voice',
         'tgl_ahir_voice' => 'Tanggal Ahir Voice',
         'budget_voice' => 'Budget Voice',
         'keterangan_voice' => 'Keterangan Voice',

         'tgl_awal_subtitle' => 'Tanggal Awal Subtitle',
         'tgl_ahir_subtitle' => 'Tanggal Ahir Subtitle',
         'budget_subtitle' => 'Budget Subtitle',
         'keterangan_subtitle' => 'Keterangan Subtitle',
            
           
        ];

        $validator =  Validator::make($request->all(), 
        [
           
         'periode_id' => 'required',
         'tgl_awal_peluang' => 'required',
         'tgl_ahir_peluang' => 'required',
         'budget_peluang' =>   'required',
         'keterangan_peluang' => 'required',

         'tgl_awal_storyline' => 'required',
         'tgl_ahir_storyline' => 'required',
         'budget_storyline' => 'required',
         'keterangan_storyline' =>'required',

         'tgl_awal_storyboard' => 'required',
         'tgl_ahir_storyboard' => 'required',
         'budget_storyboard' => 'required',
         'keterangan_storyboard' => 'required',

         'tgl_awal_lokasi' => 'required',
         'tgl_ahir_lokasi' => 'required',
         'budget_lokasi' => 'required',
         'keterangan_lokasi' => 'required',

         'tgl_awal_talent' => 'required',
         'tgl_ahir_talent' => 'required',
         'budget_talent' => 'required',
         'keterangan_talent' => 'required',

         'tgl_awal_testimoni' =>'required',
         'tgl_ahir_testimoni' => 'required',
         'budget_testimoni' => 'required',
         'keterangan_testimoni' => 'required',

         'tgl_awal_audio' => 'required',
         'tgl_ahir_audio' => 'required',
         'budget_audio' => 'required',
         'keterangan_audio' => 'required',

         'tgl_awal_editing' => 'required',
         'tgl_ahir_editing' => 'required',
         'budget_editing' => 'required',
         'keterangan_editing' => 'required',

         'tgl_awal_gambar' => 'required',
         'tgl_ahir_gambar' => 'required',
         'budget_gambar' => 'required',
         'keterangan_gambar' => 'required',

         'tgl_awal_video' => 'required',
         'tgl_ahir_video' => 'required',
         'budget_video' => 'required',
         'keterangan_video' => 'required',

         'tgl_awal_editvideo' => 'required',
         'tgl_ahir_editvideo' =>'required',
         'budget_editvideo' => 'required',
         'keterangan_editvideo' => 'required',

         'tgl_awal_grafik' => 'required',
         'tgl_ahir_grafik' => 'required',
         'budget_grafik' => 'required',
         'keterangan_grafik' => 'required',

         'tgl_awal_mixing' => 'required',
         'tgl_ahir_mixing' => 'required',
         'budget_mixing' => 'required',
         'keterangan_mixing' => 'required',


         'tgl_awal_voice' => 'required',
         'tgl_ahir_voice' => 'required',
         'budget_voice' => 'required',
         'keterangan_voice' => 'required',

         'tgl_awal_subtitle' => 'required',
         'tgl_ahir_subtitle' => 'required',
         'budget_subtitle' => 'required',
         'keterangan_subtitle' => 'required',  
        ]);

        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
         
            $errors = $validator->errors();
           

            if($errors->has('periode_id')){
                $err['messages']['periode_id'] = $errors->first('periode_id');
            }

            if($errors->has('tgl_awal_peluang')){
                $err['messages']['tgl_awal_peluang'] = $errors->first('tgl_awal_peluang');
            }

            if($errors->has('tgl_ahir_peluang')){
                $err['messages']['tgl_ahir_peluang'] = $errors->first('tgl_ahir_peluang');
            }

             if($errors->has('budget_peluang')){
                $err['messages']['budget_peluang'] = $errors->first('budget_peluang');
            }

            if($errors->has('keterangan_peluang')){
                $err['messages']['keterangan_peluang'] = $errors->first('keterangan_peluang');
            }


            if($errors->has('tgl_awal_storyline')){
                $err['messages']['tgl_awal_storyline'] = $errors->first('tgl_awal_storyline');
            }

            if($errors->has('tgl_ahir_storyline')){
                $err['messages']['tgl_ahir_storyline'] = $errors->first('tgl_ahir_storyline');
            }

             if($errors->has('budget_storyline')){
                $err['messages']['budget_storyline'] = $errors->first('budget_storyline');
            }

            if($errors->has('keterangan_storyline')){
                $err['messages']['keterangan_storyline'] = $errors->first('keterangan_storyline');
            }


            if($errors->has('tgl_awal_storyboard')){
                $err['messages']['tgl_awal_storyboard'] = $errors->first('tgl_awal_storyboard');
            }

            if($errors->has('tgl_ahir_storyboard')){
                $err['messages']['tgl_ahir_storyboard'] = $errors->first('tgl_ahir_storyboard');
            }

             if($errors->has('budget_storyboard')){
                $err['messages']['budget_storyboard'] = $errors->first('budget_storyboard');
            }

            if($errors->has('keterangan_storyboard')){
                $err['messages']['keterangan_storyboard'] = $errors->first('keterangan_storyboard');
            }

            if($errors->has('tgl_awal_lokasi')){
                $err['messages']['tgl_awal_lokasi'] = $errors->first('tgl_awal_lokasi');
            }

            if($errors->has('tgl_ahir_lokasi')){
                $err['messages']['tgl_ahir_lokasi'] = $errors->first('tgl_ahir_lokasi');
            }

             if($errors->has('budget_lokasi')){
                $err['messages']['budget_lokasi'] = $errors->first('budget_lokasi');
            }

            if($errors->has('keterangan_lokasi')){
                $err['messages']['keterangan_lokasi'] = $errors->first('keterangan_lokasi');
            }


            if($errors->has('tgl_awal_talent')){
                $err['messages']['tgl_awal_talent'] = $errors->first('tgl_awal_talent');
            }

            if($errors->has('tgl_ahir_talent')){
                $err['messages']['tgl_ahir_talent'] = $errors->first('tgl_ahir_talent');
            }

             if($errors->has('budget_talent')){
                $err['messages']['budget_talent'] = $errors->first('budget_talent');
            }

            if($errors->has('keterangan_talent')){
                $err['messages']['keterangan_talent'] = $errors->first('keterangan_talent');
            }


            if($errors->has('tgl_awal_testimoni')){
                $err['messages']['tgl_awal_testimoni'] = $errors->first('tgl_awal_testimoni');
            }

            if($errors->has('tgl_ahir_testimoni')){
                $err['messages']['tgl_ahir_testimoni'] = $errors->first('tgl_ahir_testimoni');
            }

            if($errors->has('budget_testimoni')){
                $err['messages']['budget_testimoni'] = $errors->first('budget_testimoni');
            }

            if($errors->has('keterangan_testimoni')){
                $err['messages']['keterangan_testimoni'] = $errors->first('keterangan_testimoni');
            }


            if($errors->has('tgl_awal_audio')){
                $err['messages']['tgl_awal_audio'] = $errors->first('tgl_awal_audio');
            }

            if($errors->has('tgl_ahir_audio')){
                $err['messages']['tgl_ahir_audio'] = $errors->first('tgl_ahir_audio');
            }

            if($errors->has('budget_audio')){
                $err['messages']['budget_audio'] = $errors->first('budget_audio');
            }

            if($errors->has('keterangan_audio')){
                $err['messages']['keterangan_audio'] = $errors->first('keterangan_audio');
            }

            if($errors->has('tgl_awal_editing')){
                $err['messages']['tgl_awal_editing'] = $errors->first('tgl_awal_editing');
            }

            if($errors->has('tgl_ahir_editing')){
                $err['messages']['tgl_ahir_editing'] = $errors->first('tgl_ahir_editing');
            }

            if($errors->has('budget_editing')){
                $err['messages']['budget_editing'] = $errors->first('budget_editing');
            }

            if($errors->has('keterangan_editing')){
                $err['messages']['keterangan_editing'] = $errors->first('keterangan_editing');
            }


            if($errors->has('tgl_awal_gambar')){
                $err['messages']['tgl_awal_gambar'] = $errors->first('tgl_awal_gambar');
            }

            if($errors->has('tgl_ahir_gambar')){
                $err['messages']['tgl_ahir_gambar'] = $errors->first('tgl_ahir_gambar');
            }

            if($errors->has('budget_gambar')){
                $err['messages']['budget_gambar'] = $errors->first('budget_gambar');
            }

            if($errors->has('keterangan_gambar')){
                $err['messages']['keterangan_gambar'] = $errors->first('keterangan_gambar');
            }


            if($errors->has('tgl_awal_video')){
                $err['messages']['tgl_awal_video'] = $errors->first('tgl_awal_video');
            }

            if($errors->has('tgl_ahir_video')){
                $err['messages']['tgl_ahir_video'] = $errors->first('tgl_ahir_video');
            }

            if($errors->has('budget_video')){
                $err['messages']['budget_video'] = $errors->first('budget_video');
            }

            if($errors->has('keterangan_video')){
                $err['messages']['keterangan_video'] = $errors->first('keterangan_video');
            }


            if($errors->has('tgl_awal_editvideo')){
                $err['messages']['tgl_awal_editvideo'] = $errors->first('tgl_awal_editvideo');
            }

            if($errors->has('tgl_ahir_editvideo')){
                $err['messages']['tgl_ahir_editvideo'] = $errors->first('tgl_ahir_editvideo');
            }

            if($errors->has('budget_editvideo')){
                $err['messages']['budget_editvideo'] = $errors->first('budget_editvideo');
            }

            if($errors->has('keterangan_editvideo')){
                $err['messages']['keterangan_editvideo'] = $errors->first('keterangan_editvideo');
            }



            if($errors->has('tgl_awal_grafik')){
                $err['messages']['tgl_awal_grafik'] = $errors->first('tgl_awal_grafik');
            }

            if($errors->has('tgl_ahir_grafik')){
                $err['messages']['tgl_ahir_grafik'] = $errors->first('tgl_ahir_grafik');
            }

            if($errors->has('budget_grafik')){
                $err['messages']['budget_grafik'] = $errors->first('budget_grafik');
            }

            if($errors->has('keterangan_grafik')){
                $err['messages']['keterangan_grafik'] = $errors->first('keterangan_grafik');
            }


            if($errors->has('tgl_awal_mixing')){
                $err['messages']['tgl_awal_mixing'] = $errors->first('tgl_awal_mixing');
            }

            if($errors->has('tgl_ahir_mixing')){
                $err['messages']['tgl_ahir_mixing'] = $errors->first('tgl_ahir_mixing');
            }

            if($errors->has('budget_mixing')){
                $err['messages']['budget_mixing'] = $errors->first('budget_mixing');
            }

            if($errors->has('keterangan_mixing')){
                $err['messages']['keterangan_mixing'] = $errors->first('keterangan_mixing');
            }


            if($errors->has('tgl_awal_voice')){
                $err['messages']['tgl_awal_voice'] = $errors->first('tgl_awal_voice');
            }

            if($errors->has('tgl_ahir_voice')){
                $err['messages']['tgl_ahir_voice'] = $errors->first('tgl_ahir_voice');
            }

            if($errors->has('budget_voice')){
                $err['messages']['budget_voice'] = $errors->first('budget_voice');
            }

            if($errors->has('keterangan_voice')){
                $err['messages']['keterangan_voice'] = $errors->first('keterangan_voice');
            }


            if($errors->has('tgl_awal_subtitle')){
                $err['messages']['tgl_awal_subtitle'] = $errors->first('tgl_awal_subtitle');
            }

            if($errors->has('tgl_ahir_subtitle')){
                $err['messages']['tgl_ahir_subtitle'] = $errors->first('tgl_ahir_subtitle');
            }

            if($errors->has('budget_subtitle')){
                $err['messages']['budget_subtitle'] = $errors->first('budget_subtitle');
            }

            if($errors->has('keterangan_subtitle')){
                $err['messages']['keterangan_subtitle'] = $errors->first('keterangan_subtitle');
            }


            return $err;
       }
  }


  

 

}
