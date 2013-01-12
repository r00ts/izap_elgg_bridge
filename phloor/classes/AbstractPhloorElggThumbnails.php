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
<?php

/**
 *
 */
abstract class AbstractPhloorElggThumbnails extends AbstractPhloorElggImage 
//implements IPhloorElggThumbnails 
{

	/**
	 * get the url for the image
	 */
	public function getImageURL($size = 'thumb') {				
		$sizes = array('thumb', 'tiny', 'small', 'medium', 'large');
		if(!in_array($size, $sizes)) {
			$size = 'small';		
		}
		
		$image_url = '';
		if($this->hasImage()) {
			return $this->getThumbnailURL($size);
		} 
		
		return false;
	}
	
	public function getThumbnailURL($size = 'thumb') {		
		$sizes = array('thumb', 'tiny', 'small', 'medium', 'large');
		if(!in_array($size, $sizes)) {
			$size = 'small';		
		}
		
		$thumb_url = "mod/phloor/thumbnail.php?guid={$this->guid}&size={$size}";
		
		return elgg_normalize_url($thumb_url);
	}
	
    protected function deleteImage() {
        // delete thumbnails too
        $return = $this->deleteThumbnails();
        // delete orginal image
        $return = parent::deleteImage() && $return;

        return $return;
    }

    public function createThumbnails() {
        if(!$this->hasImage()) {
            return false;
        }

        $thumbs = array( // key => (width, height, square)
			'thumbtiny'   => array('x' =>  16, 'y' =>  16, 'square' => true ),
			'thumbnail'   => array('x' =>  60, 'y' =>  60, 'square' => true ),
			'thumbsmall'  => array('x' => 153, 'y' => 153, 'square' => true ),
			'thumbmedium' => array('x' => 300, 'y' => 300, 'square' => true ),
			'thumblarge'  => array('x' => 600, 'y' => 600, 'square' => false),
        );

        $thumb = new ElggFile();
        $time = time();
        foreach($thumbs as  $key => $options) {
            $thumbnail = get_resized_image_from_existing_file($this->getImage(),
            $options['x'], $options['y'], $options['square']);

            $clean_title = ereg_replace("[^A-Za-z0-9]", "", $this->title);
            $filename = $clean_title . '.' .$key . '.' . $time . '.jpeg';
            $prefix = "phloor_elgg_image/phloor_elgg_thumbnails/";

            if ($thumbnail) {
                $thumb->setMimeType($this->getMime());
                $thumb->setFilename($prefix . $filename);
                $thumb->open("write");
                $thumb->write($thumbnail);
                $thumb->close();

                $this->set($key, $thumb->getFilenameOnFilestore());
            }
        }

        return true;
    }

    public function recreateThumbnails() {
        if(!$this->hasImage()) {
            return false;
        }

        if(!$this->deleteThumbnails()) {
            return false;
        };

        if(!$this->createThumbnails()) {
            return false;
        }

        return $this->save();
    }

    public function getThumbnail($size = 'thumb') {
        $thumbnails = $this->getThumbnails();
        if(!array_key_exists($size, $thumbnails)) {
            return false;
        }

        return $thumbnails[$size];
    }

    public function getThumbnails() {
        $files = array();
        $thumbnails = array( 
			'thumb'  => 'thumbnail',
			'tiny'   => 'thumbtiny', 
			'small'  => 'thumbsmall', 
			'medium' => 'thumbmedium', 
			'large'  => 'thumblarge',
        );
        foreach ($thumbnails as $size => $thumbkey) {
            $thumbnail = $this->get($thumbkey);
            if(file_exists($thumbnail) && is_file($thumbnail)) {
                $files[$size] = $thumbnail;
            }
        }

        return $files;
    }

    protected function deleteThumbnails() {
        $return = true;
        $thumbnails = array( 
			'thumb'  => 'thumbnail',
			'tiny'   => 'thumbtiny', 
			'small'  => 'thumbsmall', 
			'medium' => 'thumbmedium', 
			'large'  => 'thumblarge',
        );

        // delete thumbnails
        foreach ($thumbnails as $thumbkey) {
            $thumbnail = $this->get($thumbkey);
            if ($thumbnail && file_exists($thumbnail) && is_file($thumbnail)) {
                $return = @unlink($thumbnail) && $return;
                $this->set($thumbkey, '');
            }
        }

        return $return;
    }
    
    public function getIconURL($size = 'thumb') {
        if($this->hasImage()) {
            return $this->getThumbnailURL($size);
        }
        
        $sizes = array('tiny', 'small', 'medium', 'large');
		if(!in_array($size, $sizes)) {
			$size = 'small';		
		}
		
        return parent::getIconURL($size);
    }
}