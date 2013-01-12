<?php

/**
 *
 */
class PhloorNews extends AbstractPhloorElggThumbnails {

	/**
	 * Set subtype to news.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "phloor_news";
	}

	/**
	 * Can a user comment on this news?
	 *
	 * @see ElggObject::canComment()
	 *
	 * @param int $user_guid User guid (default is logged in user)
	 * @return bool
	 */
	public function canComment($user_guid = 0) {
		$result = parent::canComment($user_guid);
		if ($result == false) {
			return $result;
		}

		if ($this->comments_on == 'Off') {
			return false;
		}
		
		return true;
	}
	
    public function deleteImage() {
        return parent::deleteImage();
    }
	
}