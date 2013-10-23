<?php
App::import('Vendor','fpdf');

class FpdfHelper extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(40, 35, 40, 45);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}


function UserDefinedTable($header, $data)
{
	// Header
	foreach($header as $col =>$val)
	{
		if($col==1)
		{
			$this->Cell(37,7,$val,1);
				
		}
		elseif($col==2)
		{
			$this->Cell(10,7,$val,1);
		}
		elseif($col==3)
		{
			$this->Cell(11,7,$val,1);
		}
		elseif($col==4)
		{
			$this->Cell(16,7,$val,1);
		}
		elseif($col==5)
		{
			$this->Cell(11,7,$val,1);
		}
		elseif($col==6)
		{
			$this->Cell(11,7,$val,1);
		}
		elseif($col==7)
		{
			$this->Cell(11,7,$val,1);
		}
		elseif($col==8)
		{
			$this->Cell(11,7,$val,1);
		}
		elseif($col==10)
		{
			$this->Cell(11,7,$val,1);
		}
		
		else
		{
			$this->Cell(15,7,$val,1);
		
		}
	}
	
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col=>$key)
		{
			if($col==1)
			{
				$this->Cell(37,7,$key,1);
					
			}
			elseif($col==2)
			{
				$this->Cell(10,7,$key,1);
			}
			elseif($col==3)
			{
				$this->Cell(11,7,$key,1);
			}
			elseif($col==4)
			{
				$this->Cell(16,7,$key,1);
			}
			elseif($col==5)
			{
				$this->Cell(11,7,$key,1);
			}
			elseif($col==6)
			{
				$this->Cell(11,7,$key,1);
			}
			elseif($col==7)
			{
				$this->Cell(11,7,$key,1);
			}
			elseif($col==8)
			{
				$this->Cell(11,7,$key,1);
			}
			elseif($col==10)
			{
				$this->Cell(11,7,$key,1);
			}
			else
			{
				$this->Cell(15,7,$key,1);
			}		
		}
			
		$this->Ln();
	}
	//die;
	
	
}





}
?>