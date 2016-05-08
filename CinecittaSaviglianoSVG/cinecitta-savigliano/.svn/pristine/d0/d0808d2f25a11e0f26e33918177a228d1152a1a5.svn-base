<?php
class Facebookmd extends Model {

	function __construct()
	{
		parent::Model();
		$this->periods = array('secondi', 'minuti', 'ore', 'giorni', 'settimane', 'mesi', 'anni', 'decadi');
        $this->lengths = array('60','60','24','7','4.35','12','10');
        $this->time = time();
	}

	function send_status($status)
	{
		if($_SERVER['SERVER_NAME'] == 'jiffycal.com') return TRUE;

		$params = array(
			'access_token' => $this->_get_token(),
			'message' => $status
			);
		$post = http_build_query($params, null, '&');
		$url = 'https://graph.facebook.com/'.$this->config->item('fb_pageid').'/feed';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		#curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		#curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$id = curl_exec($ch);
		curl_close($ch);
		$id = json_decode($id, true);
		if(!empty($id['id'])) return TRUE;
		log_message('error', print_r($id, true));
		return FALSE;
	}

	function get_status()
	{
		$params = array(
			'access_token' => $this->_get_token(),
		#	'message' => 'Stiamo facendo gli ultimi aggiornamenti per il sito mobile.',
			);
		$post = http_build_query($params, null, '&');
		$url = 'https://graph.facebook.com/'.$this->config->item('fb_pageid').'/feed?'.$post;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		#curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		#curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		#curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$statuses = curl_exec($ch);
		curl_close($ch);
		$statuses = json_decode($statuses,true);
	return $statuses['data'];
	}

	function _timeago($d)
	{
		$d = $this->time - $d;
		for($j = 0; $d >= $this->lengths[$j]; $j++)
        {
            $d /= $this->lengths[$j];
        }
        $d = round($d);
		return $d.' '.$this->periods[$j]. ' fa';
	}

  function _get_token()
  {
    //Get token from DB
    $query = $this->db->query('SELECT access_token, expires FROM tbl_facebook LIMIT 1');
    $data = $query->row();
    $token = $data->access_token;

    if(time() > $data->expires - 15*24*60*60) {
      $token = $this->_set_token($token);
    }

    //$token = 'AAACDXZCXZBpeEBAKHBInROiTgkVYraCVhOIlLY8cVxb6k5yepqrvt7EtwUaStvKagw0K60AIKSFsWnXGR2RUjTWWXFXCbQ5LCVRJpqKgZDZD';
    return $token;
  }

  function _set_token($token)
  {
    //Get new token from facebook
    //Renew facebook token
    $params = array(
      'client_id'         => $this->config->item('fb_appid'),
      'client_secret'     => $this->config->item('fb_appsecret'),
      'grant_type'        => 'fb_exchange_token',
      'fb_exchange_token' => $token,
      'redirect_uri'      =>'http://www.cinecittasavigliano.it/facebook/connect/'
    );
    $post = http_build_query($params, null, '&');
    $url = 'https://graph.facebook.com/oauth/access_token?'.$post;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    #curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    #curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    #curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($ch);
    curl_close($ch);
    parse_str($result, $query);

    if(!empty($query['access_token'])) {
      //Update database
      $data = array(
        'access_token' => $query['access_token'],
        'expires'      => time() + (int) $query['expires']
      );
      $this->db->update('tbl_facebook', $data, 'id = 1');    }
    else {
      $query['access_token'] = $token;
    }

    return $query['access_token'];
  }
}

/*
object(stdClass)#17 (1) {
  ["id"]=>
  string(31) "104772962907523_101660116560476"
}
array(2) {
  ["data"]=>
  array(4) {
    [0]=>
    array(8) {
      ["id"]=>
      string(31) "104772962907523_101660116560476"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(83) "Se non avete un iPhone potete collegarvi a http://www.cinecittasavigliano.it/mobile"
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/101660116560476"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/101660116560476"
        }
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-08-22T21:56:43+0000"
      ["updated_time"]=>
      string(24) "2010-08-22T21:56:43+0000"
      ["attribution"]=>
      string(21) "CinecittÃ  Savigliano"
    }
    [1]=>
    array(9) {
      ["id"]=>
      string(31) "104772962907523_141348629235080"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(141) "Hei, lo sapevate che la nuova versione del sito CinecittÃ  ha ora anche una versione per iPhone? http://www.cinecittasavigliano.it/iphone/web"
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/141348629235080"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/141348629235080"
        }
      }
      ["privacy"]=>
      array(2) {
        ["description"]=>
        string(5) "Tutti"
        ["value"]=>
        string(8) "EVERYONE"
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-08-22T14:29:18+0000"
      ["updated_time"]=>
      string(24) "2010-08-22T14:29:18+0000"
      ["likes"]=>
      int(1)
    }
    [2]=>
    array(9) {
      ["id"]=>
      string(31) "104772962907523_152387408111143"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(146) "CinecittÃ  Ã¨ in ferie, riaprirÃ  venerdÃ¬ 27 agosto. La nuova stagione cinematografica Ã¨ alle porte e siamo pronti per proporvi i migliori film."
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/152387408111143"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/152387408111143"
        }
      }
      ["privacy"]=>
      array(2) {
        ["description"]=>
        string(5) "Tutti"
        ["value"]=>
        string(8) "EVERYONE"
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-08-19T10:14:34+0000"
      ["updated_time"]=>
      string(24) "2010-08-19T10:14:34+0000"
      ["likes"]=>
      int(2)
    }
    [3]=>
    array(8) {
      ["id"]=>
      string(31) "104772962907523_126850224026504"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(43) "Il nuovo sito di CinecittÃ  Ã¨ quasi pronto"
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/126850224026504"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/126850224026504"
        }
      }
      ["privacy"]=>
      array(2) {
        ["description"]=>
        string(5) "Tutti"
        ["value"]=>
        string(8) "EVERYONE"
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-07-30T12:46:31+0000"
      ["updated_time"]=>
      string(24) "2010-07-30T12:46:31+0000"
    }
  }
  ["paging"]=>
  array(2) {
    ["previous"]=>
    string(208) "https://graph.facebook.com/104772962907523/feed?access_token=144448172238305%7Cad6ead367f30bffaf94d91bc-741865814%7C104772962907523%7CSlB_YB4xS2arml_mXSigJHcA3MQ.&limit=25&since=2010-08-22T21%3A56%3A43%2B0000"
    ["next"]=>
    string(208) "https://graph.facebook.com/104772962907523/feed?access_token=144448172238305%7Cad6ead367f30bffaf94d91bc-741865814%7C104772962907523%7CSlB_YB4xS2arml_mXSigJHcA3MQ.&limit=25&until=2010-07-30T12%3A46%3A30%2B0000"
  }
}

















array(2) {
  ["data"]=>
  array(4) {
    [0]=>
    array(10) {
      ["id"]=>
      string(31) "104772962907523_101660116560476"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(83) "Se non avete un iPhone potete collegarvi a http://www.cinecittasavigliano.it/mobile"
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/101660116560476"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/101660116560476"
        }
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-08-22T21:56:43+0000"
      ["updated_time"]=>
      string(24) "2010-08-22T22:04:55+0000"
      ["likes"]=>
      int(1)
      ["comments"]=>
      array(2) {
        ["data"]=>
        array(1) {
          [0]=>
          array(4) {
            ["id"]=>
            string(37) "104772962907523_101660116560476_34459"
            ["from"]=>
            array(3) {
              ["name"]=>
              string(21) "CinecittÃ  Savigliano"
              ["category"]=>
              string(14) "Local_business"
              ["id"]=>
              string(15) "104772962907523"
            }
            ["message"]=>
            string(13) "test commenti"
            ["created_time"]=>
            string(24) "2010-08-22T22:04:55+0000"
          }
        }
        ["count"]=>
        int(1)
      }
      ["attribution"]=>
      string(21) "CinecittÃ  Savigliano"
    }
    [1]=>
    array(8) {
      ["id"]=>
      string(31) "104772962907523_141348629235080"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(141) "Hei, lo sapevate che la nuova versione del sito CinecittÃ  ha ora anche una versione per iPhone? http://www.cinecittasavigliano.it/iphone/web"
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/141348629235080"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/141348629235080"
        }
      }
      ["privacy"]=>
      array(2) {
        ["description"]=>
        string(5) "Tutti"
        ["value"]=>
        string(8) "EVERYONE"
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-08-22T14:29:18+0000"
      ["updated_time"]=>
      string(24) "2010-08-22T14:29:18+0000"
    }
    [2]=>
    array(9) {
      ["id"]=>
      string(31) "104772962907523_152387408111143"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(146) "CinecittÃ  Ã¨ in ferie, riaprirÃ  venerdÃ¬ 27 agosto. La nuova stagione cinematografica Ã¨ alle porte e siamo pronti per proporvi i migliori film."
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/152387408111143"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/152387408111143"
        }
      }
      ["privacy"]=>
      array(2) {
        ["description"]=>
        string(5) "Tutti"
        ["value"]=>
        string(8) "EVERYONE"
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-08-19T10:14:34+0000"
      ["updated_time"]=>
      string(24) "2010-08-19T10:14:34+0000"
      ["likes"]=>
      int(2)
    }
    [3]=>
    array(8) {
      ["id"]=>
      string(31) "104772962907523_126850224026504"
      ["from"]=>
      array(3) {
        ["name"]=>
        string(21) "CinecittÃ  Savigliano"
        ["category"]=>
        string(14) "Local_business"
        ["id"]=>
        string(15) "104772962907523"
      }
      ["message"]=>
      string(43) "Il nuovo sito di CinecittÃ  Ã¨ quasi pronto"
      ["actions"]=>
      array(2) {
        [0]=>
        array(2) {
          ["name"]=>
          string(7) "Comment"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/126850224026504"
        }
        [1]=>
        array(2) {
          ["name"]=>
          string(4) "Like"
          ["link"]=>
          string(61) "http://www.facebook.com/104772962907523/posts/126850224026504"
        }
      }
      ["privacy"]=>
      array(2) {
        ["description"]=>
        string(5) "Tutti"
        ["value"]=>
        string(8) "EVERYONE"
      }
      ["type"]=>
      string(6) "status"
      ["created_time"]=>
      string(24) "2010-07-30T12:46:31+0000"
      ["updated_time"]=>
      string(24) "2010-07-30T12:46:31+0000"
    }
  }
  ["paging"]=>
  array(2) {
    ["previous"]=>
    string(208) "https://graph.facebook.com/104772962907523/feed?access_token=144448172238305%7Cad6ead367f30bffaf94d91bc-741865814%7C104772962907523%7CSlB_YB4xS2arml_mXSigJHcA3MQ.&limit=25&since=2010-08-22T21%3A56%3A43%2B0000"
    ["next"]=>
    string(208) "https://graph.facebook.com/104772962907523/feed?access_token=144448172238305%7Cad6ead367f30bffaf94d91bc-741865814%7C104772962907523%7CSlB_YB4xS2arml_mXSigJHcA3MQ.&limit=25&until=2010-07-30T12%3A46%3A30%2B0000"
  }
}
*/