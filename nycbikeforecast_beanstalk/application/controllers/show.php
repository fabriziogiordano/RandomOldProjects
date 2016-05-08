<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class show extends CI_Controller {
  public function index() {
    $this->db->save_queries = FALSE;

    $start = strtotime('10 June 2013'); //+ 14400);
    $end = strtotime('17 June 2013'); // + 14400);

    $id = $this->db
            ->distinct()
            ->select('id, parseTime, latitude, longitude')
            ->from('stationbeanlistview')
            ->order_by('id', 'ASC')
            //->limit(1)
            ->where('parseTime >= ', $start)
            ->where('parseTime < ', $end)
            ->get();

    var_dump( $id->num_rows() );
    die;
    $last_id = 0;
    echo '<table>'."\n";
    foreach ($id->result() as $row) {
      echo '<tr>';
        echo '<td>' . $row->parseTime . '&nbsp;&nbsp;&nbsp;' . date('D M j, \<\s\p\a\n\>H:i a\<\/\s\p\a\n\>', $row->parseTime - 14400) . '</td>';
        //echo '<td>' . $row->executionTime . date('D M j, \<\s\p\a\n\>H:i a\<\/\s\p\a\n\>', $row->executionTime - 14400) . '</td>';
        //echo '<td>' . $row->id . '</td>';
        //echo '<td>' . ($last_id - $row->id) . '</td>';
        //if( ($last_id - $row->id ) == 0 )
        //  echo '<td>' . $row->id . '</td>';
        //else
        //  echo '<td>-</td>';
        //$last_id = $row->id;
      echo '</tr>'."\n";
    }
    echo '</table>';
    die;

    // 1370836801   Mon Jun 10, 00:00 am
    // 1371441301   Sun Jun 16, 23:55 pm

    $parseTime = $this->db->distinct()->select('parseTime')->from('stationBeanList')->limit(2)->order_by('parseTime', 'ASC')->get();
    $id = $this->db->distinct()->select('id, stationName, stAddress1, latitude, longitude')->from('stationBeanList')->order_by('id', 'ASC')->get();


    foreach ($parseTime->result() as $row) {
      $q = $this->db
            ->select('parseTime, id, availableBikes , availableDocks , totalDocks , statusKey , statusValue , testStation , lastCommunicationTime')
            ->from('stationBeanList')
            ->where('parseTime', $row->parseTime)
            ->get();

      foreach ($q->result() as $r) {
        echo 'parseTime: ' .             $r->parseTime . '<br>';
        echo '<strong>id: ' .            $r->id . '</strong><br>';
        echo 'availableBikes: ' .        $r->availableBikes . '<br>';
        echo 'availableDocks: ' .        $r->availableDocks . '<br>';
        echo 'totalDocks: ' .            $r->totalDocks . '<br>';
        echo 'statusKey: ' .             $r->statusKey . '<br>';
        echo 'statusValue: ' .           $r->statusValue . '<br>';
        echo 'testStation: ' .           $r->testStation . '<br>';
        echo 'lastCommunicationTime: ' . $r->lastCommunicationTime . '<br>';

        echo 'latitude: ' .              $r->latitude . '<br>';
        echo 'longitude: ' .             $r->longitude . '<br>';

        echo '<br>';
      }

    }

    $parseTime->free_result();
  }
}