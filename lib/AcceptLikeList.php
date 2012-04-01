<?php

/**
 * This file is part of BadFaith.
 *
 * Copyright (c) 2012 William Milton
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace BadFaith;

/**
 * BadFaith container for Accept-* parsing
 *
 * @package BadFaith
 * @author William Milton
 */
class AcceptLikeList {

  public $items;

  function __construct($header_str = NULL) {
    if ($header_str) {
      $this->init_with_str($header_str);
    }
  }

  function init_with_str($header_str) {
    $this->items = self::pref_parse($header_str);
  }

  static function pref_parse($header_str) {
    $parts = self::pref_split($header_str);
    $f = function ($str) {return new AcceptLike($str);};
    return array_map($f, $parts);
  }

  /**
   * Given an Accept* request-header field string, returns an array of
   * preference with parameters strings.
   * @param string $pref_with_params
   * @return array
   */
  public static function pref_split($pref_with_params) {
    $parts = array_filter(explode (',', $pref_with_params));
    $parts = array_map('trim', $parts);
    reset($parts);
    return $parts;
  }
}