<?php
require("fpdf/fpdf.php");
include("../dbheader.php");

class PDF extends FPDF {



        function BuildTable($header,$data) {
        
        //Colors, line width and bold font

        $this->SetFillColor(0,0,255);

        $this->SetTextColor(255);

        $this->SetDrawColor(0,0,0);

        $this->SetLineWidth(.3);

        $this->SetFont('','B');

        //Header

        // make an array for the column widths

        $w=array(30,30,90,50);

        // send the headers to the PDF document

        for($i=0;$i<count($header);$i++)

        $this->Cell($w[$i],7,$header[$i],1,0,'C',1);

        $this->Ln();

        //Color and font restoration

        $this->SetFillColor(175);

        $this->SetTextColor(0);

        $this->SetFont('');



        //now spool out the data from the $data array

        $fill=true; // used to alternate row color backgrounds
        
        foreach($data as $row)

        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);

        // set colors to show a URL style link

        $this->SetTextColor(0,0,0);

        $this->SetFont('');

        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill, ' ');

        // restore normal color settings

        $this->SetTextColor(0);

        $this->SetFont('');

        $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
		 $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
		


        $this->Ln();

        // flips from true to false and vise versa

        $fill =! $fill;
  
       
        }

        $this->Cell(array_sum($w),0,'','T');

        }

}



//connect to database.
$date=$_POST['field1'];
$list=explode("-",$date);
$sql =mysql_query("SELECT * from users");
$data="";



while($result=mysql_fetch_array($sql))
{
	$date1=$result['join_date'];
	$list1=explode("-",$date1);
	if($list[0]==$list1[0] && $list[1]==$list1[1] && $list[2]==$list1[2])
	
	{
		$data[] = array( $result['f_name'], $result['l_name'],  $result['email'], $result['gender']);
	}
	else
	{
	
		
		}
		
		

}

if($data=="")
{
	header("location:admin.php");
}




// build the data array from the database records.




// start and build the PDF document

$pdf = new PDF();



//Column titles

$header=array('Name','Last Name','Post Content','Post Date');



$pdf->SetFont('Arial','',14);

$pdf->AddPage();

// call the table creation method

$pdf->BuildTable($header,$data);

$pdf->Output();