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

        $w=array(20,30,90,50);

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
$id=$_POST['posts'];
$fname="";
$lname="";
$sql =mysql_query("SELECT * FROM blabs where mem_id=$id");

$sql1=mysql_query("SELECT f_name,l_name FROM users WHERE id=$id");
$count=mysql_num_rows($sql1);

	if($count==0)
	{
		echo"No details found";
	}
else
{
while($result=mysql_fetch_array($sql1))
{
	$name=$result['f_name'];
	$lname=$result['l_name'];
}




// build the data array from the database records.

while($row = mysql_fetch_array($sql)) 
{

        $data[] = array($name,$lname, $row['blab_content'], $row['blab_date']);

}



// start and build the PDF document

$pdf = new PDF();



//Column titles

$header=array('Name','Last Name','Post Content','Post Date');



$pdf->SetFont('Arial','',14);

$pdf->AddPage();

// call the table creation method

$pdf->BuildTable($header,$data);

$pdf->Output();}