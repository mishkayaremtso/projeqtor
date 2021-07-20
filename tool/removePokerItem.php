<?php
/*** COPYRIGHT NOTICE *********************************************************
 *
 * Copyright 2009-2017 ProjeQtOr - Pascal BERNARD - support@projeqtor.org
 * Contributors : -
 *
 * This file is part of ProjeQtOr.
 * 
 * ProjeQtOr is free software: you can redistribute it and/or modify it under 
 * the terms of the GNU Affero General Public License as published by the Free 
 * Software Foundation, either version 3 of the License, or (at your option) 
 * any later version.
 * 
 * ProjeQtOr is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS 
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for 
 * more details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * ProjeQtOr. If not, see <http://www.gnu.org/licenses/>.
 *
 * You can get complete code of ProjeQtOr, other resource, help and information
 * about contributors at http://www.projeqtor.org 
 *     
 *** DO NOT REMOVE THIS NOTICE ************************************************/

/** ===========================================================================
 * Delete the current object : call corresponding method in SqlElement Class
 */

require_once "../tool/projeqtor.php";

$pokerItemId=null;
if (array_key_exists('pokerItemId',$_REQUEST)) {
  $pokerItemId=$_REQUEST['pokerItemId']; // validated to be numeric value in SqlElement base constructor.
}
$pokerItemId=trim($pokerItemId);
if ($pokerItemId=='') {
  $pokerItemId=null;
} 
if ($pokerItemId==null) {
  throwError('pokerItemId parameter not found in REQUEST');
}
Sql::beginTransaction();
$obj=new PokerItem($pokerItemId);
$result=$obj->delete();
// Message of correct saving
displayLastOperationStatus($result);
?>