<?php // $Id$
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
 * (at your option) any later version.                                   
 *                                                                       
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage dashboard 
 */

/**
 * Add dashboard administration menu settings
 */

$ADMIN->add('modules', new admin_category('local_dashboard', get_string('dashboards','local_dashboard')));

// add link to dashboard management
$ADMIN->add('local_dashboard',
    new admin_externalpage('managedashboards',
        get_string('managedashboards','local_dashboard'),
        "$CFG->wwwroot/totara/dashboard/admin/index.php",
        array('totara/dashboard:admin')
    )
);

?>