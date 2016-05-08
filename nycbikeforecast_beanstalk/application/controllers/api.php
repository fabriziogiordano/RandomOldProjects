<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
  public function get($next = 0){
    $js = array();
    $json = array();
    $latitudearray = array();
    $longitudearray = array();
    $availableBikesarray = array();

    $step = 50;
    $next = intval($next) * $step;

    $start = strtotime('10 June 2013') + 14400 - 350;
    $end = strtotime('17 June 2013') + 14400 - 350;

    $start = strtotime('17 June 2013') + 14400 - 350;
    $end = strtotime('24 June 2013') + 14400 - 350;

    $parseTime = $this->db
                  ->distinct()
                  ->select('parseTime')
                  ->from('stationBeanList')
                  ->where('parseTime > ', $start)
                  ->where('parseTime <= ', $end);

    $parseTime = $this->db
                  ->limit($step, $next)
                  ->order_by('parseTime', 'ASC')
                  ->get();

    $i = $next;
    $i = 0;
    foreach ($parseTime->result() as $row) {
      $q = $this->db
            //->select('parseTime, id, latitude, longitude, availableBikes, availableDocks, totalDocks, statusKey, statusValue, testStation, lastCommunicationTime')
            ->select('id, latitude, longitude, availableBikes')
            ->from('stationBeanList')
            ->where('parseTime', $row->parseTime)
            ->where('statusValue', 'In Service')
            ->where('availableBikes >', 0)
            ->get();

      unset($js);
      foreach ($q->result() as $r) {
        //array_push($latitudearray, $r->latitude);
        //array_push($longitudearray, $r->longitude);
        //array_push($availableBikesarray, $r->availableBikes);

        $js[] = array(
          'id' => $r->id,
          'latitude' => $r->latitude,
          'longitude' => $r->longitude,
          'availableBikes' => $r->availableBikes,
          //'availableDocks' => $r->availableDocks,
          //'totalDocks' => $r->totalDocks,
          //'statusKey' => $r->statusKey,
          //'statusValue' => $r->statusValue,
          //'testStation' => $r->testStation,
          //'lastCommunicationTime' => $r->lastCommunicationTime
        );
      }

      $json[$i]['parseTime'] = date('D M j, \<\s\p\a\n\>H:i a\<\/\s\p\a\n\>', $row->parseTime - 14400);
      $json[$i]['timestamp'] = $row->parseTime - 14400;
      //$json['general']   = array(
      //                      'centre' => array(
      //                        'latitude' => (max($latitudearray)-min($latitudearray))/2+min($latitudearray),
      //                        'longitude' => (max($longitudearray)-min($longitudearray))/2+min($longitudearray)
      //                      ),
      //                      'availableBikes' => array(
      //                        'min' => min($availableBikesarray),
      //                        'max' => max($availableBikesarray)
      //                      )
      //                     );
      $json[$i]['stations'] = $js;
      $i++;
    }
    echo json_encode($json);
  }

  public function latest($next = 0){
    $js = array();
    $json = array();
    $latitudearray = array();
    $longitudearray = array();
    $availableBikesarray = array();

    $parseTimeMax = $this->db
                      ->select_max('parseTime')
                      ->from('stationBeanList')
                      ->get()
                      ->row()
                      ->parseTime;

    $q = $this->db
          //->select('parseTime, id, latitude, longitude, availableBikes, availableDocks, totalDocks, statusKey, statusValue, testStation, lastCommunicationTime')
          //->select('id, latitude, longitude, availableBikes, availableDocks')
          ->select()
          ->from('stationBeanList')
          ->where('parseTime', $parseTimeMax)
          ->where('statusValue', 'In Service')
          ->where('availableBikes >', 0)
          ->get();

    unset($js);
    foreach ($q->result() as $r) {
      //var_dump($r);
      $js[] = array(
        'id' => $r->id,
        'la' => $r->latitude,
        'lo' => $r->longitude,
        'ab' => $r->availableBikes,
        'ad' => $r->availableDocks,
        'sn' => $r->stationName
      );
    }
    $json['parseTime'] = date('D M j, \<\s\p\a\n\>H:i a\<\/\s\p\a\n\>', $parseTimeMax - 14400);
    $json['timestamp'] = $parseTimeMax - 14400;
    $json['stations'] = $js;
    echo json_encode($json);
  }
}