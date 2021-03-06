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
 * Save a note : call corresponding method in SqlElement Class
 * The new values are fetched in $_REQUEST
 */

require_once "../tool/projeqtor.php";

$idResource=RequestHandler::getId('assignmentIdResource');
$idPokerSession=RequestHandler::getId('idPokerSession');
$isTeam = RequestHandler::getBoolean('isTeam');
$isOrganization = RequestHandler::getBoolean('isOrganization');

$result=null;
$resourceList=array($idResource=>$idResource);
if($isTeam){
  $crit = array('idTeam'=>$idResource);
  $resourceList = SqlList::getListWithCrit('Resource', $crit);
}
if($isOrganization){
  $crit = array('idOrganization'=>$idResource);
  $resourceList = SqlList::getListWithCrit('Resource', $crit);
}

Sql::beginTransaction();
  foreach ($resourceList as $idResource=>$name){
    $pokerM = new PokerResource();
    $pokerM->idPokerSession = $idPokerSession;
    $pokerM->idResource = $idResource;
    $result = $pokerM->save();
  }
$status = getLastOperationStatus($result);
if ($result==null) {
  echo '<div class="messageNO_CHANGE" >'.i18n("messageNoChange").' '.i18n("PokerMember").'</div>';
  echo '<input id="lastOperationStatus" name="lastOperationStatus" type="hidden" value="NO_CHANGE"/>';
} else {
   echo '<input id="lastOperationStatus" name="lastOperationStatus" type="hidden" value="'.$status.'"/>';
   displayLastOperationStatus($result);
}
// Message of correct saving
?>