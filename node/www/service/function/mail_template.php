<?php
function template1($data,$img=NULL,$address=NULL){

$template='<div leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color:#ffffff; max-width:600px; margin:0 auto">
<table align="center" width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" style="border:#119143 1px solid">
<tbody>
<tr>
<td valign="top" align="center">
<table align="center" width="600" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="top" align="left" width="600" height="68">

<table align="center" width="560" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="middle" align="center">'.$img.$address.'</td>
</tr>
</tbody>
</table>

 </td>
</tr>
<tr>
<td valign="top" align="center" bgcolor="#ffffff" width="600" height="10"><div style="display: inline-block;">&nbsp;</div></td>
</tr>
</tbody>
</table>
<table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff">
<tbody>
<tr>
<td width="20">&nbsp;</td>
<td width="560" valign="top" align="left">
'.$data.'
  </td>
<td width="20">&nbsp;</td>
</tr>
<tr>
<td colspan="3" height="20">&nbsp;</td>
</tr>
</tbody>
</table>
<table align="center" width="560" cellspacing="0" cellpadding="0" border="0" bgcolor="#119143" style=" margin-bottom: 20px; ">
<tbody>
<tr>
<td valign="middle" align="center" style="color:#fff; padding:10px;" >
อีเมลนี้ถูกส่งโดยระบบอัตโนมัติ กรุณาอย่าตอบกลับอีเมลนี้</td></tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';

return $template;
}

function template2($data,$img=NULL,$address=NULL){

$template='<div leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color:#ffffff; max-width:600px; margin:0 auto">
<table align="center" width="600" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" style="border:#119143 1px solid">
<tbody>
<tr>
<td valign="top" align="center">
<table align="center" width="600" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="top" align="left" width="600" height="68">

<table align="center" width="560" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="middle" align="center">'.$img.$address.'</td>
</tr>
</tbody>
</table>

 </td>
</tr>
<tr>
<td valign="top" align="center" bgcolor="#ffffff" width="600" height="10"><div style="display: inline-block;">&nbsp;</div></td>
</tr>
</tbody>
</table>
<table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff">
<tbody>
<tr>
<td width="20">&nbsp;</td>
<td width="560" valign="top" align="left">
'.$data.'
  </td>
<td width="20">&nbsp;</td>
</tr>
<tr>
<td colspan="3" height="20">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';

return $template;
}
function template3($data,$img=NULL,$address=NULL){

$template='<div leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color:#ffffff; max-width:720px; height:1015px; margin:0 auto;   position: relative;">
<div style="max-width:99%; height:1025px; max-height:925px; overflow: hidden;     margin: 0 auto;" class="hprint">
<table align="center" width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="top" align="center">
<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="top" align="left" width="100%" height="68">

<table align="center" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td valign="middle" align="center">'.$img.$address.'</td>
</tr>
</tbody>
</table>

 </td>
</tr>
<tr>
<td valign="top" align="center" bgcolor="#ffffff" width="100%" height="10"><div style="display: inline-block;">&nbsp;</div></td>
</tr>
</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff">
<tbody>
<tr>
<td width="20">&nbsp;</td>
<td valign="top" align="left">
'.$data.'
  </td>
<td width="20">&nbsp;</td>
</tr>
<tr>
<td colspan="3" height="20">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
	<div style=" position: absolute; bottom: 10px;     width: 100%;">
		<div style="display:table; width:100%">
			<div style="display:table-cell; vertical-align:top; width:50%; text-align:center">สำหรับลูกค้า (For Customer)<br/><br/>......................................................</div>
			<div style="display:table-cell; vertical-align:top; width:50%; text-align:center">ผู้ปฏิบัติงาน (For Operator)<br/><br/>......................................................</div>

		</div>
	</div>
</div>';


			global $data;
						 if($data['images']!=''&&$data['images']!='{"img":[]}'){
							 

$template.='<div leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color:#ffffff; max-width:720px; height:945px; margin:0 auto;   position: relative;">';
                        
						 
							$images_arr=json_decode($data['images']);
							
							foreach($images_arr->img as $i=>$image){
								
							

                    $template.='<div style="width:50%; float:left; text-align:center; height:315px; box-sizing: border-box; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;">
					<div style="display:table; width:100%;">
					<div  style="width:50%; height:315px; display:table-cell; vertical-align:middle; text-align:center">
                     <img src="'.str_replace('|','',$image).'" width="auto" height="auto" style="border-radius: 0;padding: 10px;max-width: 100%; max-height: 100%; box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box; "></a>
                     
                      </div></div>
                    </div>';

                 
                            
                         
							}
						 
							
$template.='</div>';
}
return $template;
}

?>