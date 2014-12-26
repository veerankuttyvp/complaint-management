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
$tcpdf->xfootertext = 'Copyright Â© cake php. All rights reserved.'; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example:  
// $tcpdf->SetTextColor(0, 0, 0); 
// $tcpdf->SetFont($textfont,'B',20); 
// $tcpdf->Cell(0,14, "Hello World", 0,1,'L');
// $htmlcontent="jhfsdhfdf dfhdskjf";
$left_column="WEEKLY PROGRESS REPORT OF COMPLAINTS RECEIVED IN CMC (FROM $start_date TO $end_date )";
$y = $tcpdf->getY();

// set color for background
$tcpdf->SetFillColor(255, 255, 255);

// set color for text
$tcpdf->SetTextColor(0, 0, 0);

// write the first column
$tcpdf->writeHTMLCell(110, 50, 50, $y, $left_column, 0, 0, 1, true, 'J', true);


$date_range = $post_data['date_range'];
$htmlcontent = <<<EOF
<div>
<span>Subject:-</span> 
</div>
<div></div>
<div>
<span>
1- Daily report regarding complaints received in CMC WASA is being sent to concerned Deputy Director's and copy endst to the managing director office regularly. After prompt pursuance and follow-up of the complaints by CMC, weekly progress report is submitted for the kind perusal of worthy Managing Director, WASA as under:-
</span>
</div>
<div id="Container">
<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<th>Sub Division Name</th>
		<th>Total complaints received in CMC during the week</th>
		<th>Total complaints rectified</th>
		<th>Total complaints pending</th>
		<th colspan="3">Further action by CMC</th>
		
	</tr>
EOF;
foreach($main as $sub_details){
	$htmlcontent = $htmlcontent.
	"<tr nobr=\"true\"> 
		<td align=\"center\" valign=\"middle\"><br><br><br>".

		$sub_details['sub_name']."
		</td>
		<td align=\"center\" valign=\"middle\"><br><br><br>".
		$sub_details['total']."
		
		</td>
		<td align=\"center\" valign=\"middle\"><br><br><br>".
		$sub_details['rectfied']."
		
		</td>
		<td align=\"center\" valign=\"middle\"><br><br><br>".
		$sub_details['pending']."
		
		</td>
		<td colspan=\"3\">
		The complaints not yet rectified are being pursued vigorously and concerned formation is being reminded daily Record is being maintained in CMC showing the pursuance of the complaints

		</td>
	</tr>";
}


$htmlcontent=$htmlcontent."</table> </div>
<div>2- Although report covers the weeks from $start_date to $end_date </div>

";


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
        $html_header = '<tr><td>Name</td><td>Age</td></tr>'; 
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

echo $tcpdf->Output('complaints_count.pdf', 'D'); 


?>