<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Template Email</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">

    <style type="text/css">
        *,
        ::before,
        ::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body style="background: #f5f5f5;font-family: Montserrat, sans-serif;color: #707070;padding-top: 30px; padding-bottom: 30px;">
    <table style="padding: 30px 0px;width:500px;margin: 0px auto 0px auto;">
        <tr>
            <td>
                <div class="wrap">
                    <div class="wrap-inner" style="background:#fff;border-radius:5px;min-height:300px;padding:20px;border: 1px solid #d3d3d3;">
                        <h2 class="center" style="text-align:center !important;margin: 10px 0px;">
                            SIDAK BKPM
                        </h2>
                        <h3 style="text-align:center;">Permohonan Persetujuan </h3>
                    
                        
                        <p style="font-size: 14px;text-align:left;margin: 25px 0px 10px;">Kepada, Kementerian Investasi </p>
                        <p style="font-size: 14px;text-align:left;margin: 25px 0px 0px;">Mohon persetujuan untuk perpanjangan periode {{ $year }} semester {{ $semester }} kab/prop {{ $daerah_name }},    </p>

                           <p style="font-size: 14px;text-align:left;margin: 25px 0px 10px;">
                            <b>Alasan Perpanjangan :</b> {{ $description }}
                           </p> 

                        <h3>Link URL Detail Permohonan Persetujuan/Approval Batas periode </h3>



                        <table style="margin: 15px 0px; width: 100%;">
                            <tr>
                                <td>
                                    <div class="alert alert-success" style="border-radius:5px;padding:15px;color:#827a7a;background:#d6f5e0;">
                                      <h3> <b>{{ $url }}</b></h3>
                                        
                                    </div>

                                </td>
                            </tr>
                        </table>

                       
                        
<!-- 
                        <table style="margin: 15px 0px; width: 100%;">
                             <tr>
                                <td>Atas perhatiannya, kami ucapkan terima kasih.</td>
                             </tr>
                        </table> -->

                        <table  style="margin: 0px 0px 15px; width: 100%;">
                             <tr>
                                <td>Hormat Kami,</td>
                             </tr>
                             <tr>
                                <td>{{ $daerah_name }}</td>
                             </tr>
                        </table>
                            
                        
                    </div>
                    <table style="padding-top: 20px; width: 100%;">
                        <tr>
                            <td>
                                <p class="center footer" style="text-align:center !important;font-size:14px;">© <?php echo date("Y"); ?> SIDAK BKPM.</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>