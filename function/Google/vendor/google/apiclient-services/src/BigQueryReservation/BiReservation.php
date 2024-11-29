<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\BigQueryReservation;

class BiReservation extends \Google\Collection
{
  protected $collection_key = 'preferredTables';
  /**
   * @var string
   */
  public $name;
  protected $preferredTablesType = TableReference::class;
  protected $preferredTablesDataType = 'array';
  public $preferredTables = [];
  /**
   * @var string
   */
  public $size;
  /**
   * @var string
   */
  public $updateTime;

  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param TableReference[]
   */
  public function setPreferredTables($preferredTables)
  {
    $this->preferredTables = $preferredTables;
  }
  /**
   * @return TableReference[]
   */
  public function getPreferredTables()
  {
    return $this->preferredTables;
  }
  /**
   * @param string
   */
  public function setSize($size)
  {
    $this->size = $size;
  }
  /**
   * @return string
   */
  public function getSize()
  {
    return $this->size;
  }
  /**
   * @param string
   */
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  /**
   * @return string
   */
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BiReservation::class, 'Google_Service_BigQueryReservation_BiReservation');
