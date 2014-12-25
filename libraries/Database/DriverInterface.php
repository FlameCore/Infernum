<?php
/**
 * Infernum
 * Copyright (C) 2011 IceFlame.net
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
 * @package  FlameCore\Infernum
 * @version  0.1-dev
 * @link     http://www.flamecore.org
 * @license  ISC License <http://opensource.org/licenses/ISC>
 */

namespace FlameCore\Infernum\Database;

/**
 * The Driver interface
 *
 * @author   Christian Neff <christian.neff@gmail.com>
 */
interface DriverInterface
{
    /**
     * Connects to the database server and selects the database using the given configuration.
     *
     * @throws \RuntimeException on failure.
     */
    public function connect();

    /**
     * Closes the database connection.
     *
     * @return void
     */
    public function disconnect();

    /**
     * Performs a (optionally prepared) query on the database.
     *
     * @param string $query The SQL query to be executed
     * @param array $vars An array of values replacing the variables. Only neccessary if you're using variables.
     * @return \FlameCore\Infernum\Database\ResultInterface|bool Returns a ResultInterface instance for successful SELECT, SHOW, DESCRIBE or EXPLAIN queries.
     *   For other successful statements it will return TRUE.
     * @throws \RuntimeException on failure.
     */
    public function query($query, array $vars = null);

    /**
     * Executes the given SQL statement.
     *
     * @param $sql The statement to execute
     * @param array $vars An array of values replacing the variables. Only neccessary if you're using variables.
     * @return int Returns the number of affected rows.
     * @throws \RuntimeException on failure.
     */
    public function exec($sql, array $vars = null);

    /**
     * Performs a SELECT query.
     *
     * @param string $table The database table to query
     * @param string $columns The selected columns (Default: '*')
     * @param array $params One or more of the following parameters: (optional)
     *   * where:    The WHERE clause
     *   * vars:     An array of values replacing the variables (if neccessary)
     *   * limit:    The result row LIMIT
     *   * order:    The ORDER BY parameter
     *   * group:    The GROUP BY parameter
     * @return \FlameCore\Infernum\Database\ResultInterface Returns a result object on success.
     * @throws \RuntimeException on failure.
     */
    public function select($table, $columns = '*', array $params = []);

    /**
     * Executes an INSERT statement.
     *
     * @param string $table The database table to fill
     * @param array $data The data to insert in the form [column => value]
     * @return int Returns the number of affected rows.
     * @throws \RuntimeException on failure.
     */
    public function insert($table, array $data);

    /**
     * Executes an UPDATE statement.
     *
     * @param string $table The database table to query
     * @param array $data The new data in the form [column => value]
     * @param array $params One or more of the following parameters: (optional)
     *   * where:    The WHERE clause
     *   * vars:     An array of values replacing the variables (if neccessary)
     *   * limit:    The result row LIMIT
     * @return int Returns the number of affected rows.
     * @throws \RuntimeException on failure.
     */
    public function update($table, $data, array $params = []);

    /**
     * Batch executes the given statements.
     *
     * @param string|array $statements The statements to execute
     * @return bool Returns TRUE on success.
     * @throws \RuntimeException on failure.
     */
    public function batch($statements);

    /**
     * Imports the given SQL dump file.
     *
     * @param string $file The name of the dump file
     * @return bool Returns TRUE on success.
     * @throws \RuntimeException on failure.
     */
    public function import($file);

    /**
     * Gets the ID generated by a query on a table with a column having the AUTO_INCREMENT attribute.
     *
     * @return int Returns the ID generated by a query on a table with a column having the AUTO_INCREMENT attribute.
     *   If the last query wasn't an INSERT or UPDATE statement or if the modified table does not have a column with
     *   the AUTO_INCREMENT attribute, this function will return 0.
     */
    public function insertID();

    /**
     * Starts a transaction.
     *
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function beginTransaction();

    /**
     * Commits the current transaction.
     *
     * @return bool Returns TRUE on success or FALSE on failure or if no transaction is active.
     */
    public function commit();

    /**
     * Rolls back the current transaction.
     *
     * @return bool Returns TRUE on success or FALSE on failure or if no transaction is active.
     */
    public function rollback();

    /**
     * Checks if inside a transaction.
     *
     * @return bool
     */
    public function inTransaction();

    /**
     * Quotes a string for use in a SQL statement, taking into account the current charset of the connection.
     *
     * @param string $string The string to be escaped
     * @return string Returns the quoted string.
     */
    public function quote($string);

    /**
     * Returns the error code for the most recent statement call.
     *
     * @return int Returns the error code.
     */
    public function getError();

    /**
     * Returns extended error information associated with the last operation.
     *
     * @return array Returns the error information. The array consists of the following fields: SQLSTATE, error code, error message.
     */
    public function getErrorInfo();

    /**
     * Gets the number of already executed SQL operations.
     *
     * @return int Returns the number of already executed SQL operations.
     */
    public function getQueryCount();

    /**
     * Gets the table prefix.
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Sets the table prefix.
     *
     * @param string $prefix The table prefix to set
     */
    public function setPrefix($prefix);

    /**
     * Gets the current character set.
     *
     * @return string
     */
    public function getCharset();

    /**
     * Sets the character set to use.
     *
     * @param string $charset The character set to use
     * @return bool
     */
    public function setCharset($charset);
}
