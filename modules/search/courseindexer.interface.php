<?php

/* ========================================================================
 * Open eClass 3.0
 * E-learning and Course Management System
 * ========================================================================
 * Copyright 2003-2014  Greek Universities Network - GUnet
 * A full copyright notice can be read in "/info/copyright.txt".
 * For a full list of contributors, see "credits.txt".
 *
 * Open eClass is an open platform distributed in the hope that it will
 * be useful (without any warranty), under the terms of the GNU (General
 * Public License) as published by the Free Software Foundation.
 * The full license can be read in "/info/license/license_gpl.txt".
 *
 * Contact address: GUnet Asynchronous eLearning Group,
 *                  Network Operations Center, University of Athens,
 *                  Panepistimiopolis Ilissia, 15784, Athens, Greece
 *                  e-mail: info@openeclass.org
 * ======================================================================== */

interface CourseIndexerInterface {

    /**
     * Store a Resource in the Index.
     * 
     * @param  int     $id       - the resource id
     * @param  boolean $optimize - whether to optimize after storing
     */
    public function store($id, $optimize);

    /**
     * Remove a Resource from the Index.
     * 
     * @param int     $id         - the resource id
     * @param boolean $existCheck - whether to checking existance before removing
     * @param boolean $optimize   - whether to optimize after removing
     */
    public function remove($id, $existCheck, $optimize);

    /**
     * Build one or more Lucene Queries.
     *
     * @param  array   $data      - The data (normally $_POST), needs specific array keys, @see getDetailedSearchForm()
     * @return string             - the returned query string
     */
    public static function buildQueries($data);
}
