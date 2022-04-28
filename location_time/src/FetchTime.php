<?php

namespace Drupal\location_time;

/**
 * Class FetchTime.
 */
class FetchTime {

  /**
   * Constructs a new FetchTime object.
   */
  public function getData($Timezone) {
    date_default_timezone_set($Timezone);
    $Time = date('dS M Y - g:i A');
    return $Time;
  }

}
