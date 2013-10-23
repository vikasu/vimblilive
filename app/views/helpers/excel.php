<?php 
App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel5.php'));

class ExcelHelper extends AppHelper {
    
    var $xls;
    var $sheet;
    var $data;
    var $blacklist = array();
    var $freezePane;
    
    function excelHelper() {
        $this->xls = new PHPExcel();
        for($i=1;$i<5;$i++) {
			$this->xls->createSheet($iSheetIndex = $i);
		}
        $this->sheet = $this->xls->getActiveSheet();
        $this->sheet->getDefaultStyle()->getFont()->setName('Verdana');
    }
                 
    function generate(&$data, $title = 'Report') {
         $this->data =& $data;
         $this->_title($title);
         $this->_headers();
         //$this->freezePane($pCell = 'B4');
         $this->_rows();
         $this->_output($title);
         return true;
    }
    
    function _title($title) {
        $this->sheet->setCellValue('A2', $title);
        $this->sheet->getStyle('A2')->getFont()->setSize(14);
        $this->sheet->getRowDimension('2')->setRowHeight(23);
    }

    function _headers() {
        $i=0;
        foreach ($this->data[0] as $field => $value) {
            if (!in_array($field,$this->blacklist)) {
                $columnName = Inflector::humanize($field);
                $this->sheet->setCellValueByColumnAndRow($i++, 4, $columnName);
            }
        }
        $this->sheet->freezePane($pCell = 'B5');
        $this->sheet->getStyle('A4')->getFont()->setBold(true);
        $this->sheet->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $this->sheet->getStyle('A4')->getFill()->getStartColor()->setRGB('969696');
        $this->sheet->duplicateStyle( $this->sheet->getStyle('A4'), 'B4:'.$this->sheet->getHighestColumn().'4');
        for ($j=1; $j<$i; $j++) {
            $this->sheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($j))->setAutoSize(true);
        }
    }
        
    function _rows() {
        $i=5;
        foreach ($this->data as $row) {
            $j=0;
            foreach ($row as $field => $value) {
                if(!in_array($field,$this->blacklist)) {
                    $this->sheet->setCellValueByColumnAndRow($j++,$i, $value);
                }
            }
            $i++;
        }
    }
            
    function _output($title) {
        header("Content-type: application/vnd.ms-excel"); 
        header('Content-Disposition: attachment;filename="'.$title.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel5($this->xls);
        $objWriter->setTempDir(TMP);
        $objWriter->save('php://output');
    }
	/**
	 * Freeze pane
	 *
	 * @var string
	 */
	private $_freezePane = '';
	/**
	 * Get Freeze Pane
	 *
	 * @return string
	 */
	public function getFreezePane()
	{
		return $this->_freezePane;
	}

	/**
	 * Freeze Pane
	 *
	 * @param	string		$pCell		Cell (i.e. A1)
	 * @throws	Exception
	 * @return PHPExcel_Worksheet
	 */
	public function freezePane($pCell = 'B4')
	{
		// Uppercase coordinate
		$pCell = strtoupper($pCell);

		if (strpos($pCell,':') === false && strpos($pCell,',') === false) {
			$this->_freezePane = $pCell;
		} else {
			throw new Exception('Freeze pane can not be set on a range of cells.');
		}
		return $this;
	}

	/**
	 * Freeze Pane by using numeric cell coordinates
	 *
	 * @param	int	$pColumn	Numeric column coordinate of the cell
	 * @param	int	$pRow		Numeric row coordinate of the cell
	 * @throws	Exception
	 * @return PHPExcel_Worksheet
	 */
	public function freezePaneByColumnAndRow($pColumn = 2, $pRow = 4)
	{
		return $this->freezePane(PHPExcel_Cell::stringFromColumnIndex($pColumn) . $pRow);
	}

	/**
	 * Unfreeze Pane
	 *
	 * @return PHPExcel_Worksheet
	 */
	public function unfreezePane()
	{
		return $this->freezePane('');
	}

    /**
     * Create sheet and add it to this workbook
     *
     * @return PHPExcel_Worksheet
     */
    public function createSheet($iSheetIndex = null)
    {
        echo $iSheetIndex; exit();
		$newSheet = new PHPExcel_Worksheet($this);
        $this->addSheet($newSheet, $iSheetIndex);
		
        return $newSheet;
    }

    /**
     * Add sheet
     *
     * @param PHPExcel_Worksheet $pSheet
	 * @param int|null $iSheetIndex Index where sheet should go (0,1,..., or null for last)
     * @return PHPExcel_Worksheet
     * @throws Exception
     */
    public function addSheet(PHPExcel_Worksheet $pSheet = null, $iSheetIndex = 4)
    {
        if(is_null($iSheetIndex))
        {
            $this->_workSheetCollection[] = $pSheet;
        }
        else
        {
           echo $iSheetIndex; exit();
			// Insert the sheet at the requested index
            array_splice(
                $this->_workSheetCollection,
                $iSheetIndex,
                0,
                array($pSheet)
                );

			// Adjust active sheet index if necessary
			if ($this->_activeSheetIndex >= $iSheetIndex) {
				++$this->_activeSheetIndex;
			}

        }
		return $pSheet;
    }

}
?>