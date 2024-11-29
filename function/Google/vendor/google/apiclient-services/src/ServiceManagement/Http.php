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

namespace Google\Service\ServiceManagement;

class Http extends \Google\Collection
{
  protected $collection_key = 'rules';
  /**
   * @var bool
   */
  public $fullyDecodeReservedExpansion;
  protected $rulesType = HttpRule::class;
  protected $rulesDataType = 'array';
  public $rules = [];

  /**
   * @param bool
   */
  public function setFullyDecodeReservedExpansion($fullyDecodeReservedExpansion)
  {
    $this->fullyDecodeReservedExpansion = $fullyDecodeReservedExpansion;
  }
  /**
   * @return bool
   */
  public function getFullyDecodeReservedExpansion()
  {
    return $this->fullyDecodeReservedExpansion;
  }
  /**
   * @param HttpRule[]
   */
  public function setRules($rules)
  {
    $this->rules = $rules;
  }
  /**
   * @return HttpRule[]
   */
  public function getRules()
  {
    return $this->rules;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Http::class, 'Google_Service_ServiceManagement_Http');
