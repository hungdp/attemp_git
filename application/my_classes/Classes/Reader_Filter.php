<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author nguyenkit
 * @copyright 2012
 */

/**  Set Include path to point at the PHPExcel Classes folder  **/
//set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');
include $_SERVER['DOCUMENT_ROOT'].'/application/my_classes/Classes/PHPExcel/Reader/IReadFilter.php';




/**  Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  */
class chunkReadFilter implements PHPExcel_Reader_IReadFilter
{
	private $_startRow = 0;

	private $_endRow = 0;
    
    private $_columns = array();

	/**  Set the list of rows that we want to read  */
	public function setRows($startRow, $chunkSize, $columns) {
		$this->_startRow	= $startRow;
		$this->_endRow		= $startRow + $chunkSize;
        $this->_columns		= $columns;
	}

	public function readCell($column, $row, $worksheetName = '') {
		//  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow
		//if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) {
		if ($row >= $this->_startRow && $row < $this->_endRow) {
        	if (in_array($column,$this->_columns)) {
				return true;
			}
		}
		return false;
	}
}
?>

