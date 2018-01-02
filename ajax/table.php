<?php
require_once dirname(__FILE__) . "/fpdf/fpdf.php";
require_once dirname(__FILE__) . "/fpdi/src/autoload.php";

class PDF_MC_Table extends FPDF
{
	
	function tableRow($x, $y, $w, $data, $prop, $bold, $fontSize, $header=false){
		$nb=0;
		for($i=0;$i<count($data);$i++){
			$this->SetFont('Arial',$bold[$i],$fontSize);
			$nb=max($nb,$this->NbLines($w*$prop[$i],utf8_decode($data[$i])));
		}
		for($i=0; $i<count($data); $i++){
			$this->SetFont('Arial',$bold[$i],$fontSize);
			$h = $nb/$this->NbLines($w*$prop[$i],utf8_decode($data[$i]));
			$this->SetXY($x,$y);
			if($header){
				$this->SetXY(40,$y);
				$c = 30/$nb;
				$this->MultiCell($w*$prop[$i],$c,utf8_decode($data[$i]),1,"C", true);
			}
			else
				$this->MultiCell($w*$prop[$i],5*$h,utf8_decode($data[$i]),1,"C", true);
			$x=$x+($w*$prop[$i]);
		}
		return $y+5*$nb;
	}
	
	function summaryCell($y, $w, $data, $h, $prop){
		$x = (1-$prop)*$w+10;
		$nb=$this->NbLines($w*$prop-10,$data);
		$c = $h/$nb;
		$this->SetFont('Arial',"",10);
		$this->SetTextColor(0);
		$this->SetXY($x,$y);
		$this->MultiCell($w*$prop,$c,utf8_decode($data),1,"C");
			return $y+$h;
	}
	
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
				$sep=-1;
				$i=0;
				$j=0;
				$l=0;
				$nl=1;
				while($i<$nb)
				{
					$c=$s[$i];
					if($c=="\n")
					{
						$i++;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
						continue;
					}
					if($c==' ')
						$sep=$i;
						$l+=$cw[$c];
						if($l>$wmax)
						{
							if($sep==-1)
							{
								if($i==$j)
									$i++;
							}
							else
								$i=$sep+1;
								$sep=-1;
								$j=$i;
								$l=0;
								$nl++;
						}
						else
							$i++;
				}
				return $nl;
	}
}
?>