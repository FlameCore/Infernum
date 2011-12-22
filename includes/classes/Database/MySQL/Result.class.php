<?php
/**
 * HadesLite
 * Copyright (C) 2011 Hades Project
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE
 * FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY
 * DAMAGES WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER
 * IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING
 * OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 *
 * @package     HadesLite
 * @version     0.1-dev
 * @link        http://hades.iceflame.net
 * @license     ISC License (http://www.opensource.org/licenses/ISC)
 */
 
/**
 * Result set returned by a MySQL query
 *
 * @author  Christian Neff <christian.neff@gmail.com>
 */
class Database_MySQL_Result extends Database_Base_Result {

    /**
     * Gets a result row as an enumerated array. Returns an array of strings that corresponds to the fetched row
     *   or NULL if there are no more rows in result set.
     * @return  array
     * @access  public
     */
    public function fetchRow() {
        return mysqli_fetch_row($this->_result);
    }

    /**
     * Fetches a result row as an associative array, a numeric array, or both. Returns an array of strings that
     *   corresponds to the fetched row or NULL if there are no more rows in the resultset.
     * @param  $type   This optional parameter indicates what type of array should be produced from the current
     *                   row data. The possible values for this parameter are 'num', 'assoc' or 'both'.
     *                   Default: 'both'.
     * @return array
     * @access public
     */
    public function fetchArray($type = 'both') {
        switch ($type) {
            case 'num': $type = MYSQLI_NUM; break;
            case 'assoc': $type = MYSQLI_ASSOC; break;
            default: case 'both': $type = MYSQLI_BOTH; break;
        }
        return mysqli_fetch_array($this->_result, $type);
    }

    /**
     * Fetches a result row as an associative array. Returns an associative array of strings representing the fetched row
     *   in the result set, where each key in the array represents the name of one of the result set's columns or NULL if
     *   there are no more rows in resultset.
     * @return  array
     * @access  public
     */
    public function fetchAssoc() {
        return mysqli_fetch_assoc($this->_result);
    }

    /**
     * Fetches all result rows as an associative array, a numeric array or both. Returns an array of associative or numeric
     *   arrays holding result rows.
     * @param  $type   This optional parameter indicates what type of array should be produced from the current
     *                   row data. The possible values for this parameter are 'num', 'assoc' or 'both'.
     *                   Default: 'assoc'.
     * @return  array
     * @access  public
     */
    public function fetchAll($type = 'assoc') {
        switch ($type) {
            case 'num': $type = MYSQLI_NUM; break;
            case 'assoc': $type = MYSQLI_ASSOC; break;
            default: case 'both': $type = MYSQLI_BOTH; break;
        }
        return mysqli_fetch_all($this->_result, $type);
    }

    /**
     * Gets the number of rows in a result
     * @return  int
     * @access  public
     */
    public function numRows() {
        return mysqli_num_rows($this->_result);
    }

    /**
     * Gets the number of fields in a result
     * @return  int
     * @access  public
     */
    public function numFields() {
        return mysqli_num_fields($this->_result);
    }

    /**
     * Frees the memory associated with the result
     * @return  void
     * @access  public
     */
    public function free() {
        return mysqli_free_result($this->_result);
    }

}