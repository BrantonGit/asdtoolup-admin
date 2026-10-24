
<html>
    <head>
    <title>3M Tool Up Fulfillment Program</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1" />
    
       <style type="text/css">
      img {
    
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }
    
      a {
        text-decoration: none;
        border: 0;
        outline: none;
        color: #bbbbbb;
      }
    
      a img {
        border: none;
      }
    
      td, h1, h2, h3  {
        font-family: Helvetica, Arial, sans-serif;
        font-weight: 400;
      }
    
      td {
        text-align: center;
      }
    
      body {
        -webkit-font-smoothing:antialiased;
        -webkit-text-size-adjust:none;
        width: 100%;
        height: 100%;
        color: #37302d;
        background: #fff;
        font-size: 16px;
      }
    
       table {
        border-collapse: collapse !important;
      }
    
     .force-full-width {
      width: 100% !important;
     }
    
    
      </style>
    
      <style type="text/css" media="only screen and (max-width: 480px)">
    
        @media only screen and (max-width: 480px) {
    
          table[class="w320"] {
            width: 320px !important;
          }
        }
    
      </style>
    
    
    
    </head>
    <body class="body" style="padding:0; margin:0; display:block; background:#fff; -webkit-text-size-adjust:none" bgcolor="#fff">
    
    <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
      <tr>
        <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
          <center>
            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
              <tr>
                <td align="center" valign="top" bgcolor="#000" >
                    <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#000" style="margin:0 auto;">
                      <tr >
                          <img style="text-align:center; color: #fff;" src="https://fulfillments.branton.ca/asdtoolup/api/images/3m-logo-bw.svg" width="264" height="98"  alt="3M ASD">
                      </tr>
                    </table>
    
                    <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                      @isset($user)
                        <tr>
                          <td class="headline">
                              <br><br>
                                         <h1 style="text-align:center; font-size: 30px; color:#707070;">Hello,<br><span style="font-weight:bold; color:%color%">{{ $user }}</span></h1>
                          </td>
                        </tr>
                      @endisset
                      <tr>
                        <td>
    
                        </td>
                      </tr>
                    </table>
    
                    <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                      <tr>
                        <td style="background-color:#ffffff;" class="headline">
                          <br><br>
                                        <h2 style="text-align:center; font-size: 28px; color:#707070;">{{$message1}}</h2>
                                        <p style="text-align:center; font-size: 14px; color:#707070;">Certificate ID: {{$id}}</p>
                                        <p style="text-align:center; font-size: 14px; color:#707070;">Rebate Value: ${{$rebatevalue}} @if($country == 'us')USD @else CAD @endif</p>
                                        <p style="text-align:center; font-size: 14px; color:#707070;">Email: {{$email}}</p>
                        </td>
                      </tr>
                      <tr>
                      </tr>
    
                      <tr>
                        <td style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="80%">
                            <br><br><br>
                            <div align="center">
        <a target="_blank" href="https://fulfillments.branton.ca/asdtoolup/certificates/shipping/{{$id}}"
                  style="background-color:#ffffff;border:1px solid #616161;border-radius:0px;color:#707070;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">VIEW DETAILS</a></div>
                    <p style="text-align:center; font-size: 10px; color:#707070;"><a style="color:#707070;" target="_blank" href="https://fulfillments.branton.ca/asdtoolup/certificates/shipping/{{$id}}">https://fulfillments.branton.ca/asdtoolup/certificates/shipping/{{$id}}</a></p>
                          <br>
                          <br>
                            <br>
                        </td>
                      </tr>
                    </table>
    
                    <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#00c8e6" style="margin: 0 auto">
    
                      <tr>
                        <td style="color:#fff; font-size:12px;"><br><br>
                            3M and 3M Science. Applied to Life. are trademarks of 3M. <br>Used under license in Canada. &copy; 2021, 3M. All rights reserved.<br>
                           <br>
                           <br>
                        </td>
                      </tr>
                                          <tr>
                        <td style="color:#bbbbbb; font-size:12px;">

                           <br>
                        </td>
                      </tr>
                    </table>
                </td>
              </tr>
            </table>
        </center>
        </td>
      </tr>
    </table>
    </body>
    </html>
    