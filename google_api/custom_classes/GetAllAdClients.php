<?php
/*
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * This example gets all ad clients for the specified account.
 *
 * Tags: accounts.adclients.list
 */
class GetAllAdClients {
  /**
   * Gets all ad clients for the specified account.
   *
   * @param $service Google_Service_AdSense AdSense service object on which to
   *     run the requests.
   * @param $accountId string the ID for the account to be used.
   * @param $maxPageSize int the maximum page size to retrieve.
   * @return array the last page of retrieved ad clients.
   */
  public static function run( $service, $accountId, $maxPageSize ) {
    $optParams['pageSize'] = $maxPageSize;

    $pageToken = null;
    $adClients = array();
    do {
      $optParams['pageToken'] = $pageToken;
      $result = $service->accounts_adclients->listAccountsAdclients($accountId,
          $optParams);
      if ( ! empty( $result['adClients'] ) ) {
        foreach ( $result['adClients'] as $adClient ) {
					$adClients[] = array( 'productCode' => $adClient['productCode'], 'id' => $adClient['name'] );
        }
        $pageToken = $result['nextPageToken'];
      } else {
        return $adClients;
      }
    } while ( $pageToken );

    return $adClients;
  }
}
