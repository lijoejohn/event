<?php
extract($data);
 $html = '<table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%!important;font-family:Helvetica,Arial,sans-serif;margin:0;padding:0" width="100%" bgcolor="#DFDFDF">
           <tbody>
              <tr>
                 <td colspan="3">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="1">
                       <tbody>
                          <tr>
                             <td>
                                <div style="min-height:5px;font-size:5px;line-height:5px"> &nbsp; </div>
                             </td>
                          </tr>
                       </tbody>
                    </table>
                 </td>
              </tr>
              <tr>
                 <td>
                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="table-layout:fixed">
                       <tbody>
                          <tr>
                             <td align="center">
                                <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif;min-width:290px" width="540">
                                   <tbody>
                                      <tr>
                                         <td style="font-family:Helvetica,Arial,sans-serif">
                                            <table width="1" border="0" cellspacing="0" cellpadding="1">
                                               <tbody>
                                                  <tr>
                                                     <td>
                                                        <div style="min-height:8px;font-size:8px;line-height:8px"> &nbsp; </div>
                                                     </td>
                                                  </tr>
                                               </tbody>
                                            </table>
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" bgcolor="#DDDDDD">
                                               <tbody>
                                                  <tr>
                                                     <td align="left" valign="middle" width="95" height="21"><a style="text-decoration:none;border:none;display:block;min-height:21px;width:100%" href="" target="_blank" ><img src="https://prodwpids-idrivesafely.netdna-ssl.com/wp-content/uploads/2017/02/ids-header-logo.png" width="95" height="21" alt="Event" style="border:none;text-decoration:none"></a></td>
                                                  </tr>
                                               </tbody>
                                            </table>
                                            <table width="1" border="0" cellspacing="0" cellpadding="1">
                                               <tbody>
                                                  <tr>
                                                     <td>
                                                        <div style="min-height:8px;font-size:8px;line-height:8px"> &nbsp; </div>
                                                     </td>
                                                  </tr>
                                               </tbody>
                                            </table>
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" bgcolor="#333333">
                                               <tbody>
                                                  <tr>
                                                     <td width="20">
                                                        <table width="20" border="0" cellspacing="0" cellpadding="1">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                     <td width="100%">
                                                        <table width="500" cellspacing="0" cellpadding="1" border="0" style="table-layout:fixed">
                                                           <tbody>
                                                              <tr>
                                                                 <td width="500">
                                                                    <div style="min-height:12px;font-size:12px;line-height:12px;width:500px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                     <td width="20">
                                                        <table width="20" border="0" cellspacing="0" cellpadding="1">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                  </tr>
                                               </tbody>
                                            </table>
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" bgcolor="#FFFFFF">
                                               <tbody>
                                                  <tr>
                                                     <td width="20">
                                                        <table width="20px" border="0" cellspacing="0" cellpadding="1">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                     <td style="color:#333333;font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:18px" align="left">
                                                        <table width="1" border="0" cellspacing="0" cellpadding="1">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                        <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" bgcolor="#FFFFFF">
                                                           <tbody>
                                                              <tr>
                                                                 <td>'. ((isset($salutation) && $salutation!='')?ucwords($salutation):'Hello').'</td>
                                                              </tr>';
                                                    if(isset($intro_line)&& $intro_line!=''){
                                                        $html.='<tr>
                                                                 <td>
                                                                    <table width="1" border="0" cellspacing="0" cellpadding="1">
                                                                       <tbody>
                                                                          <tr>
                                                                             <td>
                                                                                <div style="min-height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
                                                                             </td>
                                                                          </tr>
                                                                       </tbody>
                                                                    </table>
                                                                 </td>
                                                              </tr>
                                                              <tr>
                                                                 <td>'.$intro_line.'</td>
                                                              </tr>
                                                              <tr>
                                                                 <td>
                                                                    <table width="1" border="0" cellspacing="0" cellpadding="1">
                                                                       <tbody>
                                                                          <tr>
                                                                             <td>
                                                                                <div style="min-height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
                                                                             </td>
                                                                          </tr>
                                                                       </tbody>
                                                                    </table>
                                                                 </td>
                                                              </tr>';
                                                    }
                                                        $html.= '<tr>
                                                                 <td>'.$content.'
                                                                 </td>
                                                              </tr>
                                                              <tr>
                                                                 <td>
                                                                    <table width="1" border="0" cellspacing="0" cellpadding="1">
                                                                       <tbody>
                                                                          <tr>
                                                                             <td>
                                                                                <div style="min-height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
                                                                             </td>
                                                                          </tr>
                                                                       </tbody>
                                                                    </table>
                                                                 </td>
                                                              </tr>

                                                              <tr>
                                                                 <td>We sincerely thank you for using Event!!<br></td>
                                                              </tr>
                                                              <tr>
                                                                 <td>Sincerely,</td>
                                                              </tr>
                                                              <tr>
                                                                 <td>&nbsp;</td>
                                                              </tr>
                                                              <tr>
                                                                 <td>The Event team </td>
                                                              </tr>
                                                              <tr><td><a href="www.event.com">www.event.com</a></td></tr>
                                                              <tr>
                                                                 <td>&nbsp;</td>
                                                              </tr>
                                                              <tr>
                                                                 <td>Questions, comments, concerns? Drop us a line at info@event.com</td>
                                                              </tr>
                                                              <tr>
                                                                 <td>
                                                                    <table width="1" border="0" cellspacing="0" cellpadding="1">
                                                                       <tbody>
                                                                          <tr>
                                                                             <td>
                                                                                <div style="min-height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
                                                                             </td>
                                                                          </tr>
                                                                       </tbody>
                                                                    </table>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                     <td width="20">
                                                        <table width="20px" border="0" cellspacing="0" cellpadding="1">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                  </tr>
                                               </tbody>
                                            </table>
                                         </td>
                                      </tr>
                                   </tbody>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="540">
                                   <tbody>
                                      <tr></tr>
                                   </tbody>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="540">
                                   <tbody>
                                      <tr>
                                         <td>
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%">
                                               <tbody>
                                                  <tr>
                                                     <td>
                                                        <table width="1" border="0" cellspacing="0" cellpadding="0">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:10px;font-size:10px;line-height:10px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                  </tr>
                                                  <tr>
                                                     <td align="center">
                                                     </td>
                                                  </tr>
                                                  <tr>
                                                     <td>
                                                        <table width="1" border="0" cellspacing="0" cellpadding="0">
                                                           <tbody>
                                                              <tr>
                                                                 <td>
                                                                    <div style="min-height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                     </td>
                                                  </tr>
                                               </tbody>
                                            </table>
                                         </td>
                                      </tr>
                                   </tbody>
                                </table>
                             </td>
                          </tr>
                       </tbody>
                    </table>
                 </td>
              </tr>
           </tbody>
        </table>';
echo $html;
?>