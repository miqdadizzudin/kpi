<?php
		
	require_once("phpexcel/PHPExcel.php");
	
	class Excel extends PHPExcel {
		public function __construct() {
			parent::__construct();
		}

		public function generate($param)
		{
			$this->setActiveSheetIndex(isset($param['active_sheet_index']) ? $param['active_sheet_index'] : 0);
		
			if(isset($param['worksheet_title']))
				$this->getActiveSheet()->setTitle($param['worksheet_title']);

			// header
			if(isset($param['header'])){
				foreach ($param['header'] as $header) {
					$this->getActiveSheet()->setCellValueByColumnAndRow($num,1,$header);
					$num ++;
				}
			}
			else
			{
				$num = 0;
				foreach ($param['data'][0] as $key => $dt) {
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow($num,1, $key);
					$num ++;
				}
			}

			// data
			foreach ($param['data'] as $key => $record){
				$num = 0;
				foreach ($record as $val) {
					$this->getActiveSheet()->setCellValueByColumnAndRow($num, $key+2, $val); 
					$num ++; 
				}
			}
			
			// Auto size columns for each worksheet
			foreach ($this->getWorksheetIterator() as $worksheet) {

				$this->setActiveSheetIndex($this->getIndex($worksheet));

				$sheet = $this->getActiveSheet();
				$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(true);
				/** @var PHPExcel_Cell $cell */
				foreach ($cellIterator as $cell) {
					$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
				}
			}

			$filename = isset($param['filename']) ? $param['filename'] : 'report.xls'; 

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');  
			$objWriter->save('php://output');
		}	
	}

?>