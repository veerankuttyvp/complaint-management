<?php 
App::import('Vendor','xtcpdf');
App::import('Vendor','simple_html_dom'.DS.'simple_html_dom');

$tcpdf = new XTCPDF($orientation = 'L'); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

// $tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com"); 
$tcpdf->SetAutoPageBreak(TRUE, 25);
$tcpdf->setCellPaddings(0,5,0);

$tcpdf->setHeaderFont(array($textfont,'',10)); 
$tcpdf->xheadercolor = array(255,255,255); 
$tcpdf->xheadertext = ''; 
$tcpdf->xfootertext = ''; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example:  
// $tcpdf->SetTextColor(0, 0, 0); 
// $tcpdf->SetFont($textfont,'B',20); 
// $tcpdf->Cell(0,14, "Hello World", 0,1,'L');
// $htmlcontent="jhfsdhfdf dfhdskjf";
$status_id=$post_data['status'];
if((!empty($post_data['subcategory'])) && $post_data['subcategory'] !=0){
	$category_id=$post_data['subcategory'];
}else{
	$category_id=$post_data['category'];
}
$subdivision_id=$post_data['subdivision'];
$center_id = $post_data['center'];
$date_range = $post_data['date_range'];
$htmlcontent = <<<EOF
<h2>Complaint Report</h2>
<h4>Result of search</h4>
<div>Complaint status : $status[$status_id]<div>
<div>Complaint category : $categories[$category_id]<div>
<div>Complaint subdivision : $subdivisions[$subdivision_id]<div>
<div>Complaint center : $centers[$center_id]<div>
<div>Complaint date : $date_range<div>
<br>
<div id="Container">
<table border="1" cellpadding="10">
	<tr>
		<th>Consumer</th>
		<th>Bill No</th>
		<th colspan="2" style="text-align: center;">Category</th>
		<th>Status</th>
		<th>Subdivision</th>
		<th colspan="2" style="text-align: center;">Address</th>
		
		<th>Source</th>
		<th>User</th>
		
		<th>Center Name</th>
		<th>Assigned User</th>		

	</tr>
EOF;

foreach($complaints as $complaint){
	$htmlcontent = $htmlcontent.
	"<tr nobr=\"true\"> 
		<td>".
		$complaint['Consumer']['first_name']."
		</td>
		<td>".
		$complaint['Complaint']['bill_no']."
		
		</td>
		<td colspan=\"2\" style=\"text-align: center;\">".
		$complaint['Category']['name']."
		
		</td>
		<td>".
		$complaint['ComplaintStatus']['status']."
		
		</td>
		<td>".
		$complaint['Subdivision']['name']."
		
		</td>
		<td colspan=\"2\" style=\"text-align: center;\">".
		$complaint['Complaint']['complaint_address']."
		
		</td>
		
		<td>".
		$complaint['Complaint']['source']."
		
		</td>
		<td>".
		$complaint['User']['user_name']."
		
		</td>
		<td>".$centers[$mobile_user_mobile_phones_data[$complaint['Complaint']['mobile_user_mobile_phone_id']]]."
		
		</td>
		<td>";
		if(!empty($users[$complaint['Complaint']['assigned_user']])){

			$htmlcontent = $htmlcontent.$users[$complaint['Complaint']['assigned_user']];
		}
			$htmlcontent = $htmlcontent."</td>

	</tr>";
}


$htmlcontent=$htmlcontent."</table> </div>";


$tcpdf->setAutoPageBreak(true);

//$pdf->startTransaction(); // Moved
// $html = new simple_html_dom();
// $html->load($htmlcontent);
// $single = $html->find('#Container', 0);
// if($single){

//     $rows = $single->getElementsByTagName('tr');
//     $rows = $rows[0]->getElementsByTagName('tr');

//     if($rows) {
//         $tcpdf->startTransaction(); // Start transaction only because we may need it
//         // Header for html, this starts the html and can optionally insert the header row as the first row on every new page.
//         $html_header = '<tr><td>Name</td><td>Age</td></tr>'; 
//         $html_buffer = '<table>'.$html_header;
//         for($i=1;$i<(count($rows)-1);$i++){
//             $tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html_buffer.$rows[$i]->outertext.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);

//             if ($tcpdf->getY() < ($tcpdf->getPageHeight() - 30)) { // Note the less-than operator
//                 // We might be able to add some more text, so undo that
//                 $tcpdf->rollbackTransaction(true);
//                 // And store the html
//                 $html_buffer .= $rows[$i]->outertext;
//             }else{
//                 // We exceeded our limit
//                 $tcpdf->rollbackTransaction(true);
//                 // Write last known good table
//                 $tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html_buffer.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);
//                 // Add a new page
//                 $tcpdf->AddPage();
//                 // End this transaction
//                 $tcpdf->commitTransaction();
//                 // Start a new transaction
//                 $tcpdf->startTransaction();
//                 // Reset html buffer
//                 $html_buffer = '<table>'.$html_header;
//                 // Add line we couldn't fit on last page to html buffer
//                 $html_buffer .= $rows[$i]->outertext;
//             }
//         }
//         // There is still information in our buffer and it fits on a single page
//         $tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html_buffer.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);
//         // Final commit
//         $tcpdf->commitTransaction(); 
//     }
// }
$tcpdf->setAutoPageBreak(true, 20);





$tcpdf->writeHTML($htmlcontent, true, 0, true, 0);
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('complaints.pdf', 'D'); 


?>