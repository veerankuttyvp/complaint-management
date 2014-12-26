<?php 
App::import('Vendor','xtcpdf');
App::import('Vendor','simple_html_dom'.DS.'simple_html_dom');

$tcpdf = new XTCPDF($orientation = 'L'); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

// $tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com"); 
$tcpdf->SetAutoPageBreak(TRUE, 25);
$tcpdf->setCellPaddings(0,0,0);

$tcpdf->setHeaderFont(array($textfont,'',10)); 
$tcpdf->xheadercolor = array(255,255,255); 
$tcpdf->xheadertext = ''; 
$tcpdf->xfootertext = 'Copyright Â© cake php. All rights reserved.'; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage();



$new = $this->html->url('/', true);
$new =$new.'/img/download.png'; 

$tcpdf->Image($new, 12, 12, 25, 25, 'PNG', '#', '', true, 150, '', false, false, 0, false, false, false);


$left_column ='<b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COMPLAINTS</b>';
if($post_data['date_range'] == "Select date range"){
	$date_range = "Not selected";
} else{
	$date_range = $post_data['date_range'];	
}

$right_column = '<br><br><br><br><br><br><br>&nbsp;&nbsp;Date :'.$date_range;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
$tcpdf->SetFont('times', 'BI', 25, '', 'false');
$y = $tcpdf->getY();

// set color for background
$tcpdf->SetFillColor(187, 205, 209);

// set color for text
$tcpdf->SetTextColor(100, 118, 122);

// write the first column
$tcpdf->writeHTMLCell(80, 30, 60, $y, $left_column, 1, 0, 1, true, 'J', true);

$tcpdf->SetFont('times', 'BI', 10, '', 'false');
// // set color for background
$tcpdf->SetFillColor(255, 255, 255);

// // set color for text
// $tcpdf->SetTextColor(00, 00, 0);

// write the second column
$tcpdf->writeHTMLCell(95, 30, 190, '', $right_column, 1, 1, 1, true, 'J', true); 
$tcpdf->SetFont('Courier', '', 8, '', 'false');

// Now you position and print your page content 
// example:  
// $tcpdf->SetTextColor(0, 0, 0); 
// $tcpdf->SetFont($textfont,'B',20); 
// $tcpdf->Cell(0,14, "Hello World", 0,1,'L');
// $htmlcontent="jhfsdhfdf dfhdskjf";
$htmlcontent = <<<EOF


<div></div><div></div>

<div id="Container">
<table cellspacing="0" cellpadding="10">
	<tr>
		<th><b>SR.No</b></th>
		<th colspan="2" style="text-align: center;"><b>Complaint Id</b></th>	
		<th style="text-align: center;"><b>Sub</b> <br>Div<br>No</th>
		<th style="text-align: center;" colspan="2"><b>Sub</b><br>Division</th>
		<th colspan="2"><b>Complainant Name</b></th>
		<th colspan="2"><b>Phone No</b></th>
		<th colspan="3"><b>Address</b></th>
		<th colspan="2"><b>Category</b></th>
		<th colspan="2"><b>Remarks</b></th>
		
	</tr>
	<hr>
	<hr>
EOF;
$sr_no =0;
foreach($complaints as $complaint){
	$sr_no++;
	$htmlcontent = $htmlcontent.
	"<tr nobr=\"true\">
		<td>".
		$sr_no."
		
		</td>
		<td colspan=\"2\" style=\"text-align: center;\">".
		$complaint['Complaint']['id']."
		</td>
		<td style=\"text-align: center;\">".
		$complaint['Subdivision']['id']."
		
		</td>
		<td colspan=\"2\">".
		$complaint['Subdivision']['name']."
		
		</td>
		<td colspan=\"2\">".
		$complaint['Consumer']['first_name']."
		
		</td>
		<td  colspan=\"2\">".
		$complaint['Consumer']['mobile']."
		
		</td>
		<td colspan=\"3\">".
		$complaint['Consumer']['address']."
		
		</td>
		<td colspan=\"2\">".
		$complaint['Category']['name']."
		
		</td>
		<td colspan=\"2\">".
		$complaint['ComplaintStatus']['status']."
		
		</td>
	</tr>";
}


$htmlcontent=$htmlcontent."</table> </div>";


$tcpdf->setAutoPageBreak(false);
//$pdf->startTransaction(); // Moved
$html = new simple_html_dom();
$html->load($htmlcontent);
$single = $html->find('#Container', 0);
if($single){

    $rows = $single->getElementsByTagName('tr');
    $rows = $rows[0]->getElementsByTagName('tr');

    if($rows) {
        $tcpdf->startTransaction(); // Start transaction only because we may need it
        // Header for html, this starts the html and can optionally insert the header row as the first row on every new page.
        //$html_header = '<tr><td>Name</td><td>Age</td></tr>'; 
        $html_buffer = '<table>'.$html_header;
        for($i=1;$i<(count($rows)-1);$i++){
            $tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html_buffer.$rows[$i]->outertext.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);

            if ($tcpdf->getY() < ($tcpdf->getPageHeight() - 30)) { // Note the less-than operator
                // We might be able to add some more text, so undo that
                $tcpdf->rollbackTransaction(true);
                // And store the html
                $html_buffer .= $rows[$i]->outertext;
            }else{
                // We exceeded our limit
                $tcpdf->rollbackTransaction(true);
                // Write last known good table
                $tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html_buffer.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);
                // Add a new page
                $tcpdf->AddPage();
                // End this transaction
                $tcpdf->commitTransaction();
                // Start a new transaction
                $tcpdf->startTransaction();
                // Reset html buffer
                $html_buffer = '<table>'.$html_header;
                // Add line we couldn't fit on last page to html buffer
                $html_buffer .= $rows[$i]->outertext;
            }
        }
        // There is still information in our buffer and it fits on a single page
        $tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html_buffer.'</table>', $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=false);
        // Final commit
        $tcpdf->commitTransaction(); 
    }
}
$tcpdf->setAutoPageBreak(true, 30);





$tcpdf->writeHTML($htmlcontent, true, 0, true, 0);
// ... 
// etc. 
// see the TCPDF examples  

echo $tcpdf->Output('complaints.pdf', 'D'); 


?>