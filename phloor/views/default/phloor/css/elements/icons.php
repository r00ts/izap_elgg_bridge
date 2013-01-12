<?php 
/*****************************************************************************
 * Phloor                                                                    *
 *                                                                           *
 * Copyright (C) 2011 Alois Leitner                                          *
 *                                                                           *
 * This program is free software: you can redistribute it and/or modify      *
 * it under the terms of the GNU General Public License as published by      *
 * the Free Software Foundation, either version 2 of the License, or         *
 * (at your option) any later version.                                       *
 *                                                                           *
 * This program is distributed in the hope that it will be useful,           *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 * GNU General Public License for more details.                              *
 *                                                                           *
 * You should have received a copy of the GNU General Public License         *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 *                                                                           *
 * "When code and comments disagree both are probably wrong." (Norm Schryer) *
 *****************************************************************************/ 
?>

.elgg-avatar-thumb > a > img {
	width: 60px;
	height: 60px;
	
	/* remove the border-radius if you don't want rounded avatars in supported browsers */
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	
	-moz-background-clip:  border;
	background-clip:  border;

	-webkit-background-size: 60px;
	-khtml-background-size: 60px;
	-moz-background-size: 60px;
	-o-background-size: 60px;
	background-size: 60px;
}

