<?php

class BaseController {

    /**
     * Return the response.
     */
    protected function returnResponse($type, $code, $message, $data = '') {
        http_response_code($code);
        $result = array(
            'type' => $type,
            'message' => $message,
            'data' => $data,
            'status_code' => $code
        );

        return $result;
    }

    /**
     * Get report view
     */
    protected function getReportTemplate($reportData) {
        $tblContent = '';

        if( !empty($reportData) ) {
            $tHeadContent = '';
            $tBodyContent = '';
            $headings = array_keys((array)$reportData[0]);

            foreach($headings as $title) {
                $tHeadContent = $tHeadContent . '<th>'.$title.'</th>';
            }
            $tHead = '<thead><tr>' . $tHeadContent . '</tr></thead>';
            
            foreach($reportData as $value) {
                $tRowContent = '';
                foreach($headings as $title) {
                    $tRowContent =   $tRowContent .'<td>'. $value[$title] .'</td>';
                }
                $tRow = '<tr>' . $tRowContent . '</tr>';
                $tBodyContent = $tBodyContent . $tRow;
            }

            $tBody = '<tbody>' . $tBodyContent . '</tbody>';
            $tblContent = $tHead . $tBody;
        }

        return $tblContent;
        
    }
}

?>